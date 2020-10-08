<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'email' => 'required | exists:employees,email',
            'pass' => 'required | exists:employees,password',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'メールアドレスを記入してください。',
            'email.exists' => 'メールアドレスが間違っています。',
            'pass.required' => 'パスワードを記入してください。',
            'pass.exists' => 'パスワードが間違っています。',
        ];
    }
}
