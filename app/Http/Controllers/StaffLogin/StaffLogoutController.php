<?php

namespace App\Http\Controllers\StaffLogin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class StaffLogoutController extends Controller
{

    //ログアウト
    public function logout()
    {
        session()->forget('login_check');

        return redirect('/staff/login');
    }
}
