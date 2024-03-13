<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessMail;
use App\Mail\MailResetPassword;
use App\Models\User;
use App\Rules\Phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required|unique:users,email',
            'phone' => ['valid' => new Phone],
            'role' => 'not_in:0',
            'location_model_id' => 'not_in:0'
        ]);

        $customMessages = [
            'username.required' => 'Không để trống',
            'email.required' => 'Không để trống',
            'email.unique' => 'Email đã tồn tại',
            'role' => 'Chưa chọn role',
            'location_model_id' => 'Chưa chọn location'
        ];

        $validator->setCustomMessages($customMessages);

        if ($validator->fails()) {

            $error =  $validator->errors();

            return response()->json($error);
        }

        $user = User::create([
            "name" => $request->input('username'),
            "email" => $request->input('email'),
            "phone" => $request->input('phone'),
            'email_verified_at' => now(),
            "location_model_id" => $request->input('location_model_id'),

        ]);
        $user->toArray();
        $role = Role::find($request->input('role'));
        $user->assignRole($role);
        $get_user = $request->input('email');

        $signedRoute = URL::temporarySignedRoute('form.repassword', now()->addSeconds(60), $get_user);
        $mail = new MailResetPassword($get_user, $signedRoute);

        ProcessMail::dispatch($mail);
        return response(200);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required',
            'phone' => ['valid' => new Phone],
            'role' => 'not_in:0',
            'location_model_id' => 'not_in:0'
        ]);

        $customMessages = [
            'username.required' => 'Không để trống',
            'email.required' => 'Không để trống',
            'role' => 'Chưa chọn role',
            'location_model_id' => 'Chưa chọn location'
        ];

        if ($validator->fails()) {

            $error =  $validator->errors();

            $username = $error->get('username');

            $email = $error->get('email');

            $phone = $error->get('phone');

            $role = $error->get('role');

            $location_model_id = $error->get('location_model_id');


            return response()->json([
                'username_user_error' => $username,
                'email_user_error' => $email,
                'phone_user_error' => $phone,
                'role_user_error' => $role,
                'location_model_id_user_error' => $location_model_id
            ]);
        }
        $user = User::find($request->input('id'));
        if ($user['email'] === $request->input('email')) {
            $user->update([
                'location_model_id' => $request->input('location_model_id'),
                'phone' => $request->input('phone'),
                'name' => $request->input('username')
            ]);
            $role = Role::find($request->input('role'));
            $user->syncRoles($role);
            return response($request->all());
        }
        $user->update([
            'location_model_id' => $request->input('location_model_id'),
            'phone' => $request->input('phone'),
            'name' => $request->input('username'),
            'email' => $request->input('email'),
            'email_verified_at' => null
        ]);
        $role = Role::find($request->input('role'));
        $user->syncRoles($role);
        return response($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect()->back();
    }
}
