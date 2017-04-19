<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;
use Hash;
use Auth;

class PasswordController extends Controller
{

    public function password()
    {
        return view('users.password');
    }

    /**
     * 更改密码
     * @param \App\Http\Controllers\ChangePasswordRequest $request
     */
    public function update(ChangePasswordRequest $request)
    {
        if(Hash::check($request->get('old_password'), user()->password))
        {
            user()->password = bcrypt($request->get('password'));
            user()->save();

            flash('密码修改成功', 'success');

            return back();
        }

        flash('密码修改失败', 'danger');
        return back();

    }
}
