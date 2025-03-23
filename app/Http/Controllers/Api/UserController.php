<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ControllersService;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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
}
