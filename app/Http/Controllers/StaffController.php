<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\StaffRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;

class StaffController extends Controller
{


    //スタッフ一覧
    public function list(Request $request)
    {
        //ログインチェック
        $login_check = $request->session()->get('login_check');
        if (isset($login_check) == false) {
            return redirect('/staff/login');
        }
        $login_name = $request->session()->get('login_name');

        $employees = Employee::all();

        return view('staff.list', [
            'employees' => $employees,
            'login_name' => $login_name,
        ]);
    }

    public function listSelect(Request $request)
    {
        if (isset($request->add) == true) {
            //スタッフ追加へ
            return redirect('/staff/add');
        }

        if (!empty($request->staff_id)) {
            //スタッフコードをセッション
            $staff_id = $request->staff_id;
            $request->session()->put('staff_id', $staff_id);

            if (isset($request->display) == true) {
                //スタッフ参照へ
                return redirect('/staff/display');
            }

            if (isset($request->edit) == true) {
                //スタッフ修正へ
                return redirect('/staff/edit');
            }

            if (isset($request->delete) == true) {
                //スタッフ削除へ
                return redirect('/staff/delete');
            }
        } else {
            return redirect('staff/list');
        }
    }


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
