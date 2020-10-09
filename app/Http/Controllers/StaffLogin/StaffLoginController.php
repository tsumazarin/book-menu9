<?php

namespace App\Http\Controllers\StaffLogin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StaffLoginRequest;
use App\Models\Employee;

class StaffLoginController extends Controller
{
    //ログイン
    public function login()
    {
        return view('staffLogin.login');
    }

    public function loginOk(StaffLoginRequest $request)
    {
        $login_email = $request->email;
        $login_pass = $request->pass;

        $employee = Employee::where('email', $login_email)->first();
        $login_name = $employee->name;

        $request->session()->put([
            'login_check' => 1,
            'login_name' => $login_name,
            'login_email' => $login_email,
            'login_pass' => $login_pass,
        ]);

        return redirect('/staff/top');
    }
}
