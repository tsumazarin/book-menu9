<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth;

class UserLogoutController extends Controller
{
    //
    public function logout()
    {
        Auth::logout();
        return view('auth.login');
    }
}
