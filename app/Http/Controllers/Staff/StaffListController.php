<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Employee;

class StaffListController extends Controller
{
    //
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
}
