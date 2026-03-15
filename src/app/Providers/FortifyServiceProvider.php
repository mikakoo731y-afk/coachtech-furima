<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Requests\RegisterRequest as FortifyRegisterRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Laravel\Fortify\Http\Requests\LoginRequest as FortifyLoginRequest;


class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(FortifyLoginRequest::class, LoginRequest::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::redirectUserForTwoFactorAuthenticationUsing(RedirectIfTwoFactorAuthenticatable::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        Fortify::registerView(fn() => view('auth.register'));

        Fortify::loginView(fn() => view('auth.login'));

        Fortify::verifyEmailView(fn() => view('auth.verify-email'));

        $this->app->bind(FortifyRegisterRequest::class, RegisterRequest::class);

        $this->app->instance(\Laravel\Fortify\Http\Responses\VerifyEmailResponse::class,
            new class implements \Laravel\Fortify\Contracts\VerifyEmailResponse {
                public function toResponse($request) {
                    return redirect('/mypage/profile');
                }
            }
        );
        $this->app->instance(\Laravel\Fortify\Http\Responses\VerifyEmailResponse::class,
            new class implements \Laravel\Fortify\Contracts\VerifyEmailResponse {
                public function toResponse($request) {
                    return redirect('/mypage/profile');
                }
            }
        );

        $this->app->instance(\Laravel\Fortify\Http\Responses\RegisterResponse::class,
            new class implements \Laravel\Fortify\Contracts\RegisterResponse {
                public function toResponse($request) {
                    return redirect('/email/verify');
                }
            }
        );

        Fortify::authenticateUsing(function ($request) {
            $user = \App\Models\User::where('email', $request->email)->first();

            if ($user && \Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
                return $user;
            }

            throw \Illuminate\Validation\ValidationException::withMessages([
                Fortify::username() => 'ログイン情報が登録されていません',
            ]);
        });


    }
}
