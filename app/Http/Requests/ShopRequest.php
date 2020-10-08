<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopRequest extends FormRequest
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
            'name' => ['required'],
            'email' => ['required', 'email'],
            'postal' => ['required', 'regex:/\A\d{3}[-]\d{4}\z/'],
            'address' => ['required'],
            'tel' => ['required', 'regex:/\A\d{2,5}-?\d{2,5}-?\d{4,5}\z/'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'お名前を入力してください。',
            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => 'メールアドレスの形式で入力してください。',
            'postal.required' => '郵便番号を入力してください。',
            'postal.regex' => '123-4567の形式で入力してください。',
            'address.required' => '住所を入力してください。',
            'tel.required' => '電話番号を入力してください。',
            'tel.regex' => '○○(○)-○○○○-○○○○の形で入力してください。',
        ];
    }
}
