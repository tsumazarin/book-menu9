<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'title' => 'required',
            'price' => 'required | integer | between:100,10000',
            'image' => 'required | image | mimes:jpeg,JPEG,png,PNG,jpg,JPG',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '本のタイトルを記入してください。',
            'price.required' => '値段を設定してください。',
            'price.integer' => '数字で入力してください。',
            'price.between' => '100円〜10000円の間で設定してください。',
            'image.required' => '画像を選んでください。',
            'image.image' => 'イメージファイルを選択してください。',
            'image.mimes' => '.jpeg、.JPEG、.png、.PNG、.jpg、.JPG、.HEICのファイルを選択してください。',
        ];
    }
}
