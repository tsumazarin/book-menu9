<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Employee;

class StaffDeleteController extends Controller
{
    //スタッフ削除
    public function delete(Request $request)
    {
        //ログインチェック
        $login_check = $request->session()->get('login_check');
        if (isset($login_check) == false) {
            return redirect('/staff/login');
        }
        $login_name = $request->session()->get('login_name');

        $staff_id = $request->session()->get('staff_id');

        $employee = Employee::where('id', $staff_id)->first();

        return view('staff.delete', [
            'login_name' => $login_name,
            'employee' => $employee,
        ]);
    }

    public function deleteOk(Request $request)
    {
        $staff_id = $request->session()->get('staff_id');

        $employee = Employee::where('id', $staff_id)->first();

        $request->session()->put('staff_name', $employee->name);

        $employee = Employee::find($staff_id)->delete();

        return redirect('/staff/delete-done');
    }

    public function deleteDone(Request $request)
    {
        //ログインチェック
        $login_check = $request->session()->get('login_check');
        if (isset($login_check) == false) {
            return redirect('/staff/login');
        }
        $login_name = $request->session()->get('login_name');

        $staff_name = $request->session()->get('staff_name');

        return view('staff.delete-done', [
            'login_name' => $login_name,
            'staff_name' => $staff_name,
        ]);
    }
}
