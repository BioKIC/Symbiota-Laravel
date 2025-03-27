<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Laravel\Fortify\Fortify;

class UserProfileController extends Controller {
    public static function getProfile(Request $request) {
        $user = $request->user();
        $tokens = $user->tokens;

        return view('pages/user/profile', ['user_tokens' => $tokens, 'user' => $user]);
    }

    public static function updateProfileMetadata(Request $request) {
        $user = $request->user();
        $params = $request->all();

        $params['dynamicProperties'] = $user->dynamicProperties ?? [];
        if ($params['accessibilityPref'] ?? false) {
            $params['dynamicProperties']['accessibilityPref'] = true;
        } else {
            $params['dynamicProperties']['accessibilityPref'] = false;
        }

        $user->update($params);

        return view('pages/user/profile', ['user' => $user])
            ->fragment('profile');
    }

    public static function deleteProfile(Request $request) {
        $request->user()->delete();

        return response(
            view('pages/user/profile')
        )->header('HX-Location', '/');
    }

    public static function updatePassword(Request $request) {
        $new_password = request('new_password');
        $confirm_password = request('confirm_password');

        $error = null;

        if(empty($new_password)) {
            $error = 'New Password cannot be empty';
        } else if($confirm_password != $new_password) {
            $error = 'New and Confirm Passwords must be equal';
        }

        if($error) {
            session()->flashInput($request->input());

            return response(
                view('pages/user/profile', ['errors' => new MessageBag([$error])])
                ->fragment('password')
            );
        }

        return response(
            view('pages/user/profile')
            ->fragment('password')
        );
    }
}
