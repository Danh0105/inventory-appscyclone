<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\VerificationController;

use App\Jobs\ProcessMail;
use App\Mail\MailVerification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Get view login
Route::get('/login', function () {

    if (Auth::id()) {

        return redirect()->route('dashboard.index');
    }
    return view('Admin.Auth.Login');
})->name('login');

//get view register
Route::get('/register', function () {

    return view('Admin.Auth.Register');
})->name('register');

//get view verification
Route::get('/verification', function () {

    $randomNumbers = request()->session()->get('randomNumbers');

    $email = request()->session()->get('email');

    return view('Admin.Auth.Verification', ['randomNumbers' => $randomNumbers, 'email' => $email]);
})->name('verification');

//verified
Route::get('/verified/{email}', function (string $email) {

    User::where('email', $email)->update(['email_verified_at' => now()]);

    return redirect()->route('login');
})->name('verified');

//get reset password
Route::get('/re-password', function () {

    return view('Admin.Auth.ResetPassword');
})->name('re.password');

//get form reset password
Route::get('/form-repassword/{email:signature}', function (string $email) {

    return view('Admin.Auth.FormResetPassword', ['email' => $email]);
})->name('form.repassword')->middleware('signed');
//Field Post-----------------------------------------------------------------------------------------------------------

//action: create link reset password
Route::post('/reset-password-link', [AuthController::class, 'crLinkResetPW'])->name('api.reset');

//action: reset password
Route::post('/reset-password', [AuthController::class, 'resetPW'])->name('api.resetpass');


//action: register
Route::post('/register', [AuthController::class, 'register'])->name('api.register');

//action: login
Route::post('/api-login', [AuthController::class, 'login'])->name('api.login');

//action: verification
/* Route::post('/api-verification', [AuthController::class, 'login'])->name('api.verification');
 */
//action: logout
Route::get('/logout', function () {

    Auth::logout();

    return redirect()->route('login');
})->name('logout');

//resend verification
Route::post('/re-verification', [AuthController::class, 'reVerification'])->name('re.verification');
