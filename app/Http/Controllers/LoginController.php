<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class LoginController extends Controller {
    /**
     * @OA\Get(
     *     path="/login",
     *
     *     @OA\Response(response="200", description="An example endpoint")
     * )
     */
    public function __invoke() {
        return response(view('pages/login'))->header('HX-Replace-URL', '/login');
    }

    public static function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            session()->flashInput($request->input());

            return view('pages/login', [
                'errors' => $validator->errors(),
            ])->fragment('form');
        }

        $validated = $validator->validated();

        $result = DB::select('
            SELECT uid
            FROM users
            WHERE (old_password = CONCAT(\'*\', UPPER(SHA1(UNHEX(SHA1(?)))))) AND
            email = ?',
            [$validated['password'], $validated['email']]
        );

        //Check old password
        if (count($result) > 0) {
            //Update Hashing to use new has then clear the old password for security
            DB::table('users')
                ->update([
                    'password' => Hash::make($validated['password']),
                    // TODO (Logan) offical verison should include this not doing currently so I don't mess up my login on my local db
                    //'old_password' => null,
                ]);
        }

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();

            return response(view('pages/home'))
                ->header('HX-Replace-URL', '/')
                ->header('HX-Retarget', 'body')
                ->header('HX-Boosted', 'true');
        }

        session()->flashInput($request->input());

        return view('pages/login', [
                'errors' => new MessageBag(['Invalid email or password']),
            ])->fragment('form');
    }

    public static function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response(view('pages/home'))
            ->header('HX-Replace-URL', '/');
    }
}
