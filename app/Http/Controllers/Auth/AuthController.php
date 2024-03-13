<?php

namespace App\Http\Controllers\Auth;

use App\Handle\AuthHandler;
use App\Http\Controllers\Admin\HomeController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\APIController;
use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRquest;
use App\Http\Requests\RegisterRequest;
use App\Jobs\ProcessMail;
use App\Mail\MailResetPassword;
use App\Mail\MailVerification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\ValidationException;
use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {

        $user = User::create($request->all())->toArray();

        $randomNumbers = [];

        for ($i = 0; $i < 6; $i++) {
            $randomNumbers[] = rand(0, 9);
        }

        dispatch(function () use ($user, $randomNumbers) {

            $mail = new MailVerification($user, $randomNumbers);

            ProcessMail::dispatch($mail);
        })->afterResponse();

        if ($user) {
            /* $authHandler = new AuthHandler;
            $token = $authHandler->GenerateToken($user);

            $success = [
                'user' => $user,
                'token' => $token,
            ]; */
            return redirect()->route('verification')->with(['randomNumbers' => $randomNumbers, 'email' => $user['email']]);

            /*             return redirect()->action([HomeController::class]);
 */            /*             return $this->sendResponse($success, 'user registered successfully', 201);
 */
        }
    }

    public function login(Request $request)
    {

        $input = $request->only('email', 'password');

        $validator = Validator::make($input, [
            'email' => 'required',
            'password' => 'required',
        ]);
        $user = User::where('email', $input['email'])->first();
        if (!$user) return redirect()->back()->with(['messs' => 'Tài khoản không tồn tại']);
        $user->toArray();
        if ($user['email_verified_at']) {

            if ($validator->fails()) {

                return $this->sendError('Validation Error', $validator->errors(), 422);
            }

            $remember = $request->remember;

            if (Auth::attempt($input)) {

                /*  $authHandler = new AuthHandler; */
                /*  $token = $authHandler->GenerateToken($user); */

                /* $success = ['user' => $user, 'token' => $token]; */

                /*  cookie(
                    ['token_jwt' => 'dwadawdawdawdawdw']
                ); */
                return redirect()->route('dashboard.index');
                /*  return response()->json($token = session('jwt_token')); */
                /*  return $this->sendResponse($success, 'Logged In');*/
            } else {

                return redirect()->back()->with(['messs' => 'Email hoặc mật khẩu không đúng']);
            }
        } else {

            $randomNumbers = [];

            for ($i = 0; $i < 6; $i++) {

                $randomNumbers[] = rand(0, 9);
            }

            dispatch(function () use ($user, $randomNumbers) {

                $mail = new MailVerification($user, $randomNumbers);

                ProcessMail::dispatch($mail);
            })->afterResponse();

            return redirect()->route('verification')->with(['randomNumbers' => $randomNumbers, 'email' => $user['email']]);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->sendResponse([], 'Logged Out');
    }

    public function crLinkResetPW(PasswordRquest $request)
    {
        $get_user = $request->input('email');

        $signedRoute = URL::temporarySignedRoute('form.repassword', now()->addSeconds(60), $get_user);
        $mail = new MailResetPassword($get_user, $signedRoute);

        ProcessMail::dispatch($mail);

        return view('Mail.Success', ['email' => $get_user]);
    }
    public function resetPW(Request $request)
    {

        $pass = Hash::make($request->input('password'));

        User::where('email', $request->input('email'))->update(['password' => $pass]);

        return response()->json($request->all());
    }

    public function reVerification(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|axist_email',
            'g-recaptcha-response' => 'required',
        ]);

        $customMessages = [
            'email.required' => 'Vui lòng điền địa chỉ email.',
            'email.axist_email' => 'Địa chỉ email không hợp lệ.',
            'g-recaptcha-response.required' => 'Vui lòng xác minh Captcha.',
        ];

        $validator->setCustomMessages($customMessages);

        if ($validator->fails()) {

            $error =  $validator->errors();

            $gRecaptchaErrors = $error->get('g-recaptcha-response');

            $email = $error->get('email');

            return response()->json(['gRecaptchaErrors' => $gRecaptchaErrors, 'errorEmail' => $email]);
        }

        $email['email'] = $request->input('email');
        $email['name'] = $request->input('name');
        for ($i = 0; $i < 6; $i++) {

            $randomNumbers[] = rand(0, 9);
        }

        dispatch(function ()  use ($email, $randomNumbers) {
            $mail = new MailVerification($email, $randomNumbers);
            ProcessMail::dispatch($mail);
        })->afterResponse();

        return response()->json(['randomNumbers' => $randomNumbers, 'email' => $email], 200);
    }

    public function sendResponse($data, $message, $status = 200)
    {
        $response = [
            'data' => $data,
            'message' => $message
        ];

        return response()->json($response, $status);
    }
    /* 
    public function sendError($message, $errorData = [], $status = 400)
    {
        $response = [
            'message' => $message
        ];

        if (!empty($errorData)) {

            $response['data'] = $errorData;
        }

        return response()->json($response, $status);
    }

    public function resourceNotFoundResponse(string $resource)
    {
        $response = [
            'error' => "The $resource wasn't found",
        ];

        return response()->json($response, 404);
    } */
}
