<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller {
    /**
     * @return View
     */
    public function __invoke() {
        return view('pages/signup');
    }

    /**
     * @return <missing>|Response
     */
    public static function register(Request $request) {

        /* Email currently isn't unique in our db */
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|max:100',
            'name' => 'required|string',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            session()->flashInput($request->input());

            return view('pages/signup', [
                'errors' => $validator->errors(),
            ])->fragment('signup-form');
        }

        $validated = $validator->validated();

        $name_parts = explode(' ', $validated['name'], 2);

        if (count($name_parts) >= 1) {
            $validated['firstName'] = $name_parts[0];
        }
        if (count($name_parts) >= 2) {
            $validated['lastName'] = $name_parts[1];
        } else {
            $validated['lastName'] = $validated['name'];
        }

        $user = new User();
        $user->fill($validated);
        $user->save();

        $content = view('pages/login');

        return response($content)
            ->header('HX-Replace-URL', '/')
            ->header('HX-Retarget', '#app-body');
    }
}
