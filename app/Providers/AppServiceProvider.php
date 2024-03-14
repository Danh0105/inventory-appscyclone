<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\UrlGenerator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Auth::viaRequest('jwt', static function (Request $request) {
            $token = $request->header('Authorization', null);
            if ($token === null) {
                return null;
            }
            $token = (array) JWT::decode(str_replace('Bearer', '', $token), new Key(env('APP_KEY'), 'HS256'));
            $user = new User();
            $user->setRawAttributes($token);
            return $user;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(UrlGenerator $url): void
    {
        Validator::extend('axist_email', function ($attribute, $value, $parameters, $validator) {
            return User::where('email', $value)->count() !== 0;
        });
        if (env('APP_ENV') == 'production') {
            $url->forceScheme('https');
        }
    }
}
