<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\StaffRequest;
use App\Models\Employee;

class StaffAddController extends Controller
{
    //スタッフ追加
    public function add(Request $request)
    {
        //ログインチェック
        $login_check = $request->session()->get('login_check');
        if (isset($login_check) == false) {
            return redirect('/staff/login');
        }
        $login_name = $request->session()->get('login_name');

        return view('staff.add', ['login_name' => $login_name]);
    }

    public function addOk(StaffRequest $request)
    {
        $staff_name = $request->name;
        $staff_email = $request->email;
        $staff_pass = $request->pass;

        $request->session()->put([
            'staff_name' => $staff_name,
            'staff_email' => $staff_email,
            'staff_pass' => $staff_pass,
        ]);

        return redirect('/staff/add-check');
    }

    //スタッフ追加チェック
    public function addCheck(Request $request)
    {
        //ログインチェック
        $login_check = $request->session()->get('login_check');
        if (isset($login_check) == false) {
            return redirect('/staff/login');
        }
        $login_name = $request->session()->get('login_name');

        $staff_name = $request->session()->get('staff_name');
        $staff_email = $request->session()->get('staff_email');
        $staff_pass = $request->session()->get('staff_pass');

        return view('staff.add-check', [
            'login_name' => $login_name,
            'staff_name' => $staff_name,
            'staff_email' => $staff_email,
            'staff_pass' => $staff_pass,
        ]);
    }

    public function addCheckOk(Request $request)
    {
        $staff_name = $request->session()->get('staff_name');
        $staff_email = $request->session()->get('staff_email');
        $staff_pass = $request->session()->get('staff_pass');

        $employee_info = [
            'name' => $staff_name,
            'password' => $staff_pass,
            'email' => $staff_email,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $employee = new Employee;
        unset($employee_info['_token']);
        $employee->fill($employee_info)->save();

        return redirect('/staff/add-done');
    }

    //スタッフ追加完了
    public function addDone(Request $request)
    {
        //ログインチェック
        $login_check = $request->session()->get('login_check');
        if (isset($login_check) == false) {
            return redirect('/staff/login');
        }
        $login_name = $request->session()->get('login_name');

        $staff_name = $request->session()->get('staff_name');

        return view('staff.add-done', [
            'login_name' => $login_name,
            'staff_name' => $staff_name,
        ]);
    }
}
