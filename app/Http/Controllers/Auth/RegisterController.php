<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8', 'confirmed'],
            'postal' => ['required', 'regex:/\A\d{3}[-]\d{4}\z/'],
            'address' => ['required'],
            'tel' => ['required', 'regex:/\A\d{2,5}-?\d{2,5}-?\d{4,5}\z/'],
        ], [
            'name.required' => 'お名前を入力してください。',
            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => 'メールアドレスの形式で入力してください。',
            'email.unique' => 'メールアドレスはすでに登録されています。',
            'password.required' => 'パスワードを入力してください。',
            'password.min' => '8文字以上で入力してください。',
            'password.confirmed' => 'パスワードが一致していません。',
            'postal.required' => '郵便番号を入力してください。',
            'postal.regex' => '「123-4567」の形で入力してください。',
            'address.required' => '住所を入力してください。',
            'tel.required' => '電話番号を入力してください。',
            'tel.regex' => '○○(○)-○○○○-○○○○の形で入力してください。',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'postal' => $data['postal'],
            'address' => $data['address'],
            'tel' => $data['tel'],
        ]);
    }
}
