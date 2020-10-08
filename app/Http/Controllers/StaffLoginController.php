<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\StaffLoginRequest;
use Illuminate\Support\Facades\DB;

class StaffLoginController extends Controller
{
    //
    public function login()
    {
        return view('staffLogin.login');
    }

    public function loginOk(StaffLoginRequest $request)
    {
        $login_email = $request->email;
        $login_pass = $request->pass;

        $employee = DB::table('employees')
            ->where('email', $login_email)
            ->first();
        $login_name = $employee->name;

        $request->session()->put([
            'login_check' => 1,
            'login_name' => $login_name,
            'login_email' => $login_email,
            'login_pass' => $login_pass,
        ]);

        return redirect('/staff/top');
    }

    public function logout()
    {
        session()->forget('login_check');

        return redirect('/staff/login');
    }

    public function top(Request $request)
    {
        //ログインチェック
        $login_check = $request->session()->get('login_check');
        if (isset($login_check) == false) {
            return redirect('/staff/login');
        }
        $login_name = $request->session()->get('login_name');

        return view('staffLogin.top', ['login_name' => $login_name]);
    }
}
