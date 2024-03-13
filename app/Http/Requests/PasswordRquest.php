<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRquest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|axist_email',
            'g-recaptcha-response' => ['required', new \App\Rules\ValidRecaptcha]
        ];
    }
    public function messages(): array
    {
        return [
            'email.axist_email' => 'Email chưa đăng ký tài khoản',
            'email.required' => 'Email không để trống',
            'g-recaptcha-response' => 'Bạn không phải người',
        ];
    }
}
