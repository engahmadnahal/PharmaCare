<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Resources\Api\ErrorResponse;
use App\Http\Resources\Api\SuccessResponse;
use App\Models\City;
use App\Models\Country;
use App\Models\Region;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use Throwable;

class AuthSocialController extends Controller
{

   
    
    public function getUrl($provider){
        if(!in_array($provider,['google','apple','facebook'])){
            return response()->json(new ErrorResponse('ERROR'),Response::HTTP_BAD_REQUEST);
        }
        return response()->json(new SuccessResponse('SUCCESS_GET',[
            'redirect_url' => route('auth.social.redirect',$provider)
        ]),Response::HTTP_OK);
    }

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function appRedirect()
    {
        // For Open App using deep link flutter
        $token = request()->get('token');
        $status = request()->get('status');
        $type = request()->get('type'); // login or sigunup
        $fname = request()->get('fname');
        $lname = request()->get('lname');
        $email = request()->get('email');
        $deepLink = "photome://photome.nahal2.me?status={$status}&token={$token}&type={$type}&fname={$fname}&lname={$lname}&email={$email}";
        return redirect()->away($deepLink);
    }
    public function callback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $response = match ($provider) {
            'google' => $this->google($user),
            'facebook' => $this->facebook($user),
            'apple' => $this->apple($user),
        };

        $userExists = User::where('provider_id', $response['id'])->orWhere('email',$response['email'])->first();
        if (!is_null($userExists)) {
            $user = $userExists;
            $type = 'login';
        }else{
            $user = $this->createUser($response);
            $type = 'sigunup';
        }
        $tokenUser = $user->createToken('socialQarenApp');

        return redirect()->to(route('auth.social.app.redirect', [
            'status' => true, 
            'token' => $tokenUser->accessToken,
            'type' => $type,
            'fname' => $user->first_name,
            'lname' => $user->last_name,
            'email' => $user->email
        ]));

        try {
        } catch (Throwable $e) {
            return "Error ...";
        }
    }

    private function google($user)
    {
        $data['name'] = $user->getName();
        $data['email'] = $user->getEmail();
        $data['avater'] = $user->getAvatar();
        $data['id'] = $user->getId();
        $data['password'] = Hash::make(Str::random(12));
        $data['activeEmail'] = now();
        $data['auth_type'] = 'google';
        $data['token'] = $user->token;
        return $data;
    }

    private function facebook($user)
    {
        $data['name'] = $user->getName();
        $data['email'] = $user->getEmail();
        $data['avater'] = $user->getAvatar();
        $data['id'] = $user->getId();
        $data['password'] = Hash::make(Str::random(12));
        $data['activeEmail'] = now();
        $data['auth_type'] = 'facebook';
        $data['token'] = $user->token;
        return $data;
    }

    private function apple($user)
    {
        $data['name'] = $user->getName();
        $data['email'] = $user->getEmail();
        $data['avater'] = $user->getAvatar();
        $data['id'] = $user->getId();
        $data['password'] = Hash::make(Str::random(12));
        $data['activeEmail'] = now();
        $data['auth_type'] = 'apple';
        $data['token'] = $user->token;
        return $data;
    }



    private function createUser($data)
    {
        $name = explode(' ', $data['name']);
        // $exists = User::where('provider_id', $data['id'])->orWhere('email',$data['email'])->first();
        // if (!is_null($exists)) {
        //     return $exists;
        // }
        $user = new User();
        $user->user_num = random_int(100000000, 999999999);
        $user->provider_id = $data['id'];
        $user->provider_token = $data['token'];

        $user->first_name = $name[0];
        $user->last_name = $name[count($name) - 1];
        // $user->birth_date = now();  // Defualt Data
        $user->address = 'address'; // Defualt Data
        $user->street_name = 'street_name'; // Defualt Data
        $user->phone_number = 'phone_number'; // Defualt Data
        $user->home_number = 0000000; // Defualt Data
        $user->flat_number = 0000000; // Defualt Data
        // $user->account_type = $request->input('account_type');
        $user->region_id = Region::first()->id; // Defualt Data
        $user->city_id = City::first()->id; // Defualt Data
        $user->country_id = Country::first()->id; // Defualt Data
        $user->email = $data['email'];
        $user->account_status = 'Verified';
        // $user->longitude = $request->input('longitude');
        // $user->latitude = $request->input('latitude');
        // $user->radius_store = $request->input('radius_store');
        $user->password = $data['password'];
        $user->gender = 'M';
        $user->agree = true;
        $user->invition_id = Str::uuid();
        $user->ip = request()->ip();
        $user->type_auth = $data['auth_type'];
        $isSaved = $user->save();
        return $user;
    }


    public function dataUserAuthSocial(Request $request){
        $roles = [
            'birth_date' => 'required|date:Y-m-d',
            'address' => 'required|string',
            'street_name' => 'required|string',
            'phone_number' => 'required|string|unique:users,phone_number',
            'home_number' => 'required|string',
            'flat_number' => 'required|string',
            'account_type' => 'required|string|in:Regular,Professional',
            'region_id' => 'required|numeric|exists:regions,id',
            'job_id' => 'required|numeric|exists:jobs,id',
            'city_id' => 'required|numeric|exists:cities,id',
            'country_id' => 'required|numeric|exists:countries,id',
            'gender' => 'required|string|in:M,F',
            'longitude' => 'required|string',
            'latitude' => 'required|string',
            'radius_store' => 'required|integer',
            'password' => 'required|min:6|max:12|confirmed',
        ];
        $validator = Validator($request->all(), $roles);
        if (!$validator->fails()) {
            $user = User::find(auth()->user()->id);
            $user->birth_date = $request->input('birth_date');
            $user->address = $request->input('address');
            $user->street_name = $request->input('street_name');
            $user->phone_number = $request->input('phone_number');
            $user->home_number = $request->input('home_number');
            $user->flat_number = $request->input('flat_number');
            $user->account_type = $request->input('account_type');
            $user->region_id = $request->input('region_id');
            $user->city_id = $request->input('city_id');
            $user->country_id = $request->input('country_id');
            $user->job_id = $request->input('job_id');
            $user->longitude = $request->input('longitude');
            $user->latitude = $request->input('latitude');
            $user->password = Hash::make($request->input('password'));
            $user->radius_store = $request->input('radius_store');
            $user->gender = $request->input('gender');
            $isSaved = $user->save();
            if ($isSaved) {
                $controller = new ApiAuthController;
                $controller->setAddressUser($request, $user);
                $controller->generatSetting($user);
                return $controller->generateToken($request,$user,'social');
            } else {
                return response()->json(new ErrorResponse('REGISTER_FAILED'),Response::HTTP_BAD_REQUEST);
            }
        } else {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
    }
}
