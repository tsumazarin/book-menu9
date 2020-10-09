<?php

namespace App\Http\Controllers\StaffLogin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class StaffTopController extends Controller
{
    //管理トップページ
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
