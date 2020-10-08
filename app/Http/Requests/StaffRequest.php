<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class StaffRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required | email | unique:employees,email',
            'pass' => 'required',
            'pass2' => 'required | same:pass',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'スタッフ名を記入してください。',
            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => 'メールアドレスの形式で記入してください。',
            'email.unique' => 'このメールアドレスは登録されています。',
            'pass.required' => 'パスワードを記入してください。',
            'pass2.required' => '確認用パスワードも記入してください。',
            'pass2.same:pass' => 'パスワードが一致しておりません。',

        ];
    }
}
