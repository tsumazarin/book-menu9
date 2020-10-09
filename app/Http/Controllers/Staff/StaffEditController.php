<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\StaffRequest;
use App\Models\Employee;

class StaffEditController extends Controller
{
    //スタッフ修正
    public function edit(Request $request)
    {
        //ログインチェック
        $login_check = $request->session()->get('login_check');
        if (isset($login_check) == false) {
            return redirect('/staff/login');
        }
        $login_name = $request->session()->get('login_name');

        $staff_id = $request->session()->get('staff_id');

        $employee = Employee::where('id', $staff_id)->first();

        return view('staff.edit', [
            'login_name' => $login_name,
            'employee' => $employee,
        ]);
    }

    public function editOk(StaffRequest $request)
    {
        $staff_name = $request->name;
        $staff_email = $request->email;
        $staff_pass = $request->pass;

        $request->session()->put([
            'staff_name' => $staff_name,
            'staff_email' => $staff_email,
            'staff_pass' => $staff_pass,
        ]);

        return redirect('/staff/edit-check');
    }

    //スタッフ修正チェック
    public function editCheck(Request $request)
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

        return view('staff.edit-check', [
            'login_name' => $login_name,
            'staff_name' => $staff_name,
            'staff_email' => $staff_email,
            'staff_pass' => $staff_pass,
        ]);
    }

    public function editCheckOk(Request $request)
    {
        $staff_id = $request->session()->get('staff_id');
        $staff_name = $request->session()->get('staff_name');
        $staff_pass = $request->session()->get('staff_pass');
        $staff_email = $request->session()->get('staff_email');

        $employee_info = [
            'name' => $staff_name,
            'password' => $staff_pass,
            'email' => $staff_email,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $employee = Employee::find($staff_id);
        unset($employee_info['_token']);
        $employee->fill($employee_info)->save();

        return redirect('/staff/edit-done');
    }

    //スタッフ修正完了
    public function editDone(Request $request)
    {
        //ログインチェック
        $login_check = $request->session()->get('login_check');
        if (isset($login_check) == false) {
            return redirect('/staff/login');
        }
        $login_name = $request->session()->get('login_name');

        $staff_name = $request->session()->get('staff_name');

        return view('staff.edit-done', [
            'login_name' => $login_name,
            'staff_name' => $staff_name,
        ]);
    }
}
