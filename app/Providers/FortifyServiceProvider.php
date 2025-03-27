<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\FailedPasswordConfirmationResponse;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\PasswordConfirmedResponse;
use Laravel\Fortify\Contracts\RegisterResponse;
use Laravel\Fortify\Contracts\TwoFactorDisabledResponse;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     */
    public function register(): void {
        $this->app->instance(LoginResponse::class, new class() implements LoginResponse {
            public function toResponse($request) {
                $url = session()->get('link') ?? url('');

                return response(redirect($url))
                    ->header('HX-Retarget', 'body')
                    ->header('HX-Location', $url)
                    ->header('HX-Boosted', 'true');
            }
        });

        $this->app->instance(RegisterResponse::class, new class() implements RegisterResponse {
            public function toResponse($request) {
                return response(view('pages/home'))
                    ->header('HX-Replace-URL', url(config('fortify.home')))
                    ->header('HX-Retarget', 'body')
                    ->header('HX-Boosted', 'true');
            }
        });

        $this->app->instance(TwoFactorDisabledResponse::class, new class() implements TwoFactorDisabledResponse {
            public function toResponse($request) {
                return response(view('pages/user/profile'))
                    ->header('HX-Retarget', 'body')
                    ->header('HX-Boosted', 'true');
            }
        });

        $this->app->instance(PasswordConfirmedResponse::class, new class() implements PasswordConfirmedResponse {
            public function toResponse($request) {
                return response(view('/pages/user/profile'))
                    ->header('HX-Retarget', 'body')
                    ->header('HX-Request', 'true');
            }
        });

        $this->app->instance(FailedPasswordConfirmationResponse::class, new class() implements FailedPasswordConfirmationResponse {
            public function toResponse($request) {

                $message = __('The provided password was incorrect.');

                return response(view('/pages/auth/confirm-password',
                    ['errors' => new MessageBag([$message])]
                ))
                    ->header('HX-Retarget', 'body')
                    ->header('HX-Request', 'true');
            }
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {

        Fortify::loginView(function (Request $request) {
            //If Request Redirect on to self then only send fragment. This is for htmx to do the correct swap
            //
            if (! session()->has('link')) {
                session(['link' => url()->previous()]);
            }

            // If its on current page ignore target
            if ($request->headers->get('hx-request') && ! $request->headers->get('hx-target')) {
                return view('pages/login')->fragment('form');
            }

            return response(view('pages/login'))->header('HX-Replace-URL', url('/login'));
        });

        Fortify::registerView(function (Request $request) {
            //If Request Redirect on to self then only send fragment. This is for htmx to do the correct swap
            if ($request->headers->get('hx-request') && ! $request->headers->get('hx-target')) {
                return view('pages/signup')->fragment('form');
            }

            return response(view('pages/signup'))->header('HX-Replace-URL', url('/register'));
        });

        Fortify::requestPasswordResetLinkView(function (Request $request) {
            //If Request Redirect on to self then only send fragment. This is for htmx to do the correct swap

            return response(view('pages/auth/forgot-password')
            )->header('HX-Replace-URL', url('/forgot-password'));
        });

        Fortify::confirmPasswordView(function () {
            return response(view('pages/auth/confirm-password'))
                //->header('HX-Replace-URL', '/auth/confirm-password')
                ->header('HX-Retarget', 'body')
                ->header('HX-Request', 'true');
        });

        Fortify::twoFactorChallengeView(function () {
            return response(view('pages/auth/two-factor-challenge'))
                ->header('HX-Request', 'true')
                ->header('HX-Replace-URL', url('/two-factor-challenge'))
                ->header('HX-Boosted', 'true')
                ->header('HX-Retarget', 'body');
        });

        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)->first();

            if ($user &&
                Hash::check($request->password, $user->password)) {
                return $user;
            }

            //Check Old Password
            $old_check = User::query()
                ->whereRaw('(password = CONCAT(\'*\', UPPER(SHA1(UNHEX(SHA1(?))))))', [$request->password])
                ->where('email', $request->email)
                ->select('uid')
                ->first();

            if ($user && $old_check) {
                return $user;
            }
        });

        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
