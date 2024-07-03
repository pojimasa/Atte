<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|max:20|confirmed',
        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            $email = $this->input('email');
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $validator->errors()->add('email', '有効なメールアドレスを入力してください。');
            } elseif (!str_contains($email, '@')) {
                $validator->errors()->add('email', 'メールアドレスに＠を挿入してください。');
            }
        });
    }

    public function messages()
    {
        return [
            'name.required' => 'お名前を入力してください。',
            'email.required' => 'メールアドレスを入力してください。',
            'email.unique' => 'このメールアドレスは既に登録されています。',
            'password.required' => 'パスワードを入力してください。',
            'password.min' => 'パスワードは8文字以上で入力してください。',
            'password.max' => 'パスワードは20文字以内で入力してください。',
            'password.confirmed' => 'パスワードが一致しません。',
        ];
    }
}
