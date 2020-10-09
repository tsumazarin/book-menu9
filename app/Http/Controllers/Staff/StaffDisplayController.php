<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Employee;

class StaffDisplayController extends Controller
{
    //スタッフ参照
    public function display(Request $request)
    {
        //ログインチェック
        $login_check = $request->session()->get('login_check');
        if (isset($login_check) == false) {
            return redirect('/staff/login');
        }
        $login_name = $request->session()->get('login_name');

        $staff_id = $request->session()->get('staff_id');

        $employee = Employee::where('id', $staff_id)->first();

        return view('staff.display', [
            'login_name' => $login_name,
            'employee' => $employee,
        ]);
    }
}
