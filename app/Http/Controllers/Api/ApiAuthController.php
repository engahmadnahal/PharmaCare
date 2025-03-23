<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ControllersService;
use App\Helpers\Messages;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ErrorResponse;
use App\Http\Resources\Api\SuccessResponse;
use App\Http\Resources\Api\UserResource;
use App\Http\Resources\UserWithOutTokenResource;
use App\Http\Trait\CustomTrait;
use App\Mail\SendCodeVerifiy;
use App\Models\Admin;
use App\Models\MobileToken;
use App\Models\PasswordResetUser;
use App\Models\User;
use App\Models\UserDrug;
use App\Models\UserInfo;
use App\Notifications\SimpleNotificaion;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthController extends Controller
{

    public function login(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|string|exists:users,email',
            'password' => 'required|string|max:12',
        ]);

        if ($validator->fails()) {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }

        $user = User::where('email', $request->input('email'))->first();

        if (is_null($user)) {
            return ControllersService::generateValidationErrorMessage(__('cms.acount_not_found'));
        }

        if ($user->status) {
            if (!Hash::check($request->input('password'), $user->password)) {
                return ControllersService::generateValidationErrorMessage(__('cms.error_password'));
            }

            return $this->generateToken($user);
        }
    }

    private function generateToken($user)
    {
        try {
            $token = $user->createToken('user-api');
            $user->setAttribute('token', $token->accessToken);

            return ControllersService::successResponse(__('cms.success_login'), new UserResource($user));
        } catch (Exception $e) {
            return ControllersService::generateValidationErrorMessage(__('cms.error_login') . ' ' . $e->getMessage());
        }
    }


    public function checkCodeforgetPassword(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|string|exists:users,email',
            'code' => 'required|string|max:5'
        ]);

        if (!$validator->fails()) {
            $user = User::where('email', $request->get('email'))->first();

            if (!Hash::check($request->input('code'), $user->verification_code)) {
                return ControllersService::generateValidationErrorMessage(__('cms.password_reset_code_error'));
            }

            return ControllersService::successResponse(__('cms.password_reset_code_correct'));
        }

        return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
    }


    public function forgetPassword(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|string|exists:users,email'
        ]);

        if ($validator->fails()) {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }

        $user = User::where('email', $request->get('email'))->first();
        $this->sendActivationCodeDebug($user, 55555);
        return ControllersService::successResponse(__('cms.forget_password_success'), 55555);
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|string|exists:users,email',
            'password' => 'required|string|confirmed',
            'code' => 'required|string|max:5'
        ]);

        if ($validator->fails()) {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }

        $user = User::where('email', $request->get('email'))->first();

        if (!is_null($user->verification_code) && Hash::check($request->input('code'), $user->verification_code)) {
            $user->password = Hash::make($request->input('password'));
            $user->save();

            $this->revokePreviousTokens($user->id);
            return ControllersService::successResponse(__('cms.reset_password_success'));
        }
        return ControllersService::generateValidationErrorMessage(__('cms.no_password_reset_code'));
    }

    public function changePassword(Request $request)
    {
        $validator = Validator($request->all(), [
            'current_password' => 'required|string|min:3',
            'new_password' => 'required|string|confirmed',
        ]);

        if ($validator->fails()) {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }

        $user = auth('user-api')->user();
        if (!Hash::check($request->get('current_password'), $user->password)) {
            return ControllersService::generateValidationErrorMessage(__('cms.current_password_error'));
        }

        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        $this->revokePreviousTokens($user->id, auth()->user()->token()->id);

        return ControllersService::successResponse(__('cms.change_password_success'));
    }


    public function register(Request $request)
    {
        $validator = Validator($request->all(), [
            'full_name' => 'required|string|min:3',
            'gender' => 'required|string|in:male,female',
            'date_of_birth' => 'required|date',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:6',
            'mobile' => 'required|string|unique:users,mobile',

            // User Info validation
            'width' => 'required|string',
            'length' => 'required|string',
            'blood_type' => 'nullable|string|in:A,B,AB,O',
            'is_allergies' => 'required|boolean',
            'is_genetic_diseases' => 'required|boolean',
            'genetic_diseases' => 'nullable|string|in:genetic,chronic,both',
            'allergies' => 'nullable|string|in:medication,food,both',

            // User Drugs validation
            'drugs' => 'required|array',
            'drugs.*.name' => 'required|string|max:255',
            'drugs.*.dosage' => 'required|string|max:255',
            'drugs.*.diseases' => 'required|string|max:255',
            'drugs.*.type' => 'required|string|in:permanent,temporary',
            'drugs.*.duration' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }

        DB::beginTransaction();
        try {
            // Create user
            $user = new User();
            $user->full_name = $request->full_name;
            $user->gender = $request->gender;
            $user->date_of_birth = $request->date_of_birth;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->mobile = $request->mobile;
            $save = $user->save();

            if (!$save) {
                throw new \Exception(__('cms.faild_create_user'));
            }

            // Create user info
            $userInfo = new UserInfo();
            $userInfo->user_id = $user->id;
            $userInfo->width = $request->width;
            $userInfo->length = $request->length;
            $userInfo->blood_type = $request->blood_type;
            $userInfo->is_allergies = $request->is_allergies;
            $userInfo->is_genetic_diseases = $request->is_genetic_diseases;
            $userInfo->genetic_diseases = $request->genetic_diseases;
            $userInfo->allergies = $request->allergies;
            $save = $userInfo->save();

            if (!$save) {
                throw new \Exception(__('cms.faild_create_user_info'));
            }

            // Create user drugs if provided
            $userDrugs = [];
            foreach ($request->drugs as $drug) {
                $userDrugs[] = [
                    'user_id' => $user->id,
                    'name' => $drug['name'],
                    'dosage' => $drug['dosage'],
                    'diseases' => $drug['diseases'],
                    'duration' => $drug['duration'] ?? null,
                    'type' => $drug['type'],
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }

            $save = UserDrug::insert($userDrugs);

            if (!$save) {
                throw new \Exception(__('cms.faild_create_user_drug'));
            }

            DB::commit();
            try {
                $admin = Admin::first();
                if ($admin) {
                    $admin->notify(new SimpleNotificaion([
                    'title' => __('cms.new_user_registration'),
                    'body' => __('cms.new_user_registration_body', ['name' => $user->full_name])
                    ]));
                }
            } catch (\Exception $e) {}
            return ControllersService::successResponse(__('cms.register_success'),[]);
        } catch (\Exception $e) {
            DB::rollBack();
            return ControllersService::generateValidationErrorMessage($e->getMessage());
        }
    }


    public function updateProfile(Request $request) {}

    private function sendActivationCodeDebug(User $user, $code)
    {
        $user->verification_code = Hash::make($code);
        $user->save();
    }

    private function sendActivationCode(User $user)
    {
        $code = random_int(10000, 99999);
        $user->verification_code = Hash::make($code);
        $user->save();
        Mail::to($user)->send(new SendCodeVerifiy($code));
    }

    public function sendResetPasswordCode(User $user, $code)
    {
        $user->verification_code = Hash::make($code);
        $user->save();
        Mail::to($user)->send(new SendCodeVerifiy($code));
    }


    public function logout(Request $request)
    {
        $token = auth('user-api')->user()->token();
        $token->revoke();
        return ControllersService::successResponse(__('cms.logged_out_successfully'));
    }

    private function revokePreviousTokens($userId, $currentToken = null)
    {
        if ($currentToken) {
            DB::table('oauth_access_tokens')
                ->where('user_id', $userId)
                ->where('id', '<>', $currentToken)
                ->update([
                    'revoked' => true
                ]);
        } else {
            DB::table('oauth_access_tokens')
                ->where('user_id', $userId)
                ->update([
                    'revoked' => true
                ]);
        }
    }
}
