<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ControllersService;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\UserInfo;
use App\Models\UserDrug;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        try {
            $user = $request->user()->load(['info', 'drugs', 'medicalRecords']);

            return ControllersService::successResponse(__('cms.profile_retrieved_successfully'), new ProfileResource($user));
        } catch (\Exception $e) {
            return ControllersService::generateValidationErrorMessage($e->getMessage());
        }
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $validator = Validator($request->all(), [
            'full_name' => 'required|string|min:3',
            'gender' => 'required|string|in:male,female',
            'date_of_birth' => 'required|date',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'mobile' => 'required|string|max:11|unique:users,mobile,' . $user->id,

        ]);

        if ($validator->fails()) {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }

        try {
            $user->full_name = $request->full_name;
            $user->gender = $request->gender;
            $user->date_of_birth = $request->date_of_birth;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $save = $user->save();

            if (!$save) {
                throw new \Exception(__('cms.failed_update_user'));
            }

            return ControllersService::successResponse(
                __('cms.profile_updated_successfully'),
                new ProfileResource($user->fresh(['info', 'drugs', 'medicalRecords']))
            );
        } catch (\Exception $e) {
            return ControllersService::generateValidationErrorMessage($e->getMessage());
        }
    }
}
