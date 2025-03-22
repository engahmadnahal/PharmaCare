<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ControllersService;
use App\Http\Controllers\Controller;
use App\Http\Trait\CustomTrait;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    use CustomTrait;


    public function showLogin(Request $request)
    {

        $request->merge(['guard' => $request->guard]);

        $validator = Validator($request->all(), [
            'guard' => 'required|string|in:admin,employee'
        ]);

        if (!$validator->fails()) {
            session()->put('guard', $request->input('guard'));
            return response()->view('cms.auth.signin', ['guard' => $request->input('guard')]);
        }

        abort(404);
    }


    public function login(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|string',
            'password' => 'required|string|min:3|max:10',
            'remember' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }

        $guard = session('guard');
        $credentials = ['email' => $request->get('email'), 'password' => $request->get('password')];

        if (Auth::guard($guard)->attempt($credentials, $request->get('remember'))) {
            // last_login
            if ($guard == 'admin') {
                $user = auth('admin')->user();
                $user->last_login = now();
                $user->save();
            }
            return response()->json(['message' => 'Logged in successfully'], Response::HTTP_OK);
        }

        return response()->json(['message' => 'Error credentials, please try again'], Response::HTTP_BAD_REQUEST);
    }

    public function logout(Request $request)
    {
        $guard = session('guard');
        Auth::guard($guard)->logout();
        $request->session()->invalidate();
        return redirect()->route('cms.login', $guard);
    }

    public function editPassword()
    {
        $user = auth()->user();
        return response()->view('cms.auth.profile.change-password', ['user' => $user]);
    }

    public function updatePassword(Request $request)
    {
        $guard = session('guard');
        $validator = Validator($request->all(), [
            'current_password' => 'required|string|current_password:' . $guard,
            'new_password' => 'required|string|confirmed',
        ]);

        if (!$validator->fails()) {
            $user = $request->user();
            $user->password = Hash::make($request->input('new_password'));
            $isSaved = $user->save();
            return response()->json([
                'message' => $isSaved ? 'Password changed successfully' : 'Failed to change password!'
            ], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function profilePersonalInformatiion(Request $request)
    {

        if (auth('admin')->check()) {
            $user = auth('admin')->user();
        } else {
            return abort(404);
        }
        return response()->view('cms.auth.profile.personal-information', ['user' => $user]);
    }

    public function updateProfilePersonalInformation(Request $request)
    {

        $user = auth()->user();
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'email' => "required|string|email|unique:admins,email," . $user->id,
        ]);

        if (!$validator->fails()) {

            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $isSaved = $user->save();

            return response()->json(['message' => $isSaved ? __('cms.create_success') : __('cms.create_failed')], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function profileAccountInformatiion(Request $request)
    {
        $user = auth()->user();
        return response()->view('cms.auth.profile.account-information', ['user' => $user]);
    }



    public function profileStore()
    {
        return view('cms.auth.store-profile.profile');
    }


    public function logoAndImage()
    {
        return view('cms.auth.profile.store.image-cover', ['user' => auth()->user()]);
    }

    public function storeImageAndCover(Request $request)
    {
        $validator = Validator($request->all(), [
            'logo' =>  ['nullable', 'image', 'mimes:jpg,png,jpeg,gif'],
            'cover' => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif']

        ]);

        if (!$validator->fails()) {
            $store = auth()->user();
            if ($request->hasFile('logo')) {
                $store->logo = $this->uploadFile($request->file('logo'));
            }
            if ($request->hasFile('cover')) {
                $store->cover = $this->uploadFile($request->file('cover'));
            }
            $isSaved = $store->save();
            return ControllersService::generateProcessResponse($isSaved, 'UPDATE');
        } else {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
    }

    public function showRegionInfo()
    {
        $languages = Language::all();
        return view('cms.auth.profile.store.region-info', ['user' => auth()->user(), 'languages' => $languages]);
    }

    public function editRegionInfo(Request $request)
    {
        $validator = Validator($request->all(), [
            'longitude' => 'required|string',
            'latitude' => 'required|string',
            'region' => 'required|string|exists:regions,id',
        ]);

        if (!$validator->fails()) {
            $store = auth()->user();
            $store->longitude = $request->input('longitude');
            $store->latitude = $request->input('latitude');
            $store->region_id = $request->input('region');
            $isSaved = $store->save();

            return ControllersService::generateProcessResponse($isSaved, 'UPDATE');
        } else {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
    }


    public function readNotification()
    {
        auth()->user()->unreadNotifications->markAsRead();
    }
}
