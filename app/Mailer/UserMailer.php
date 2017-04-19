<?php

namespace App\Mailer;

use Illuminate\Support\Facades\Mail;
use Auth;
use App\Models\User;

/**
 * Class UserMailer
 *
 * @package \App\Mailer
 */
class UserMailer extends Mailer
{
    public function followNotifyEmail($email)
    {
        $data = ['url' => "http://zhihu.app", 'name' => Auth::guard('api')->user()->name];

        $this->sendTo("digtime_app_new_user_follow", $email, $data);
    }

    /**
     * 重置密码邮箱
     * @param $token
     * @param $email
     */
    public function resetPassword($token, $email)
    {
        // 模板变量
        $data = [
            'url' => url('password/reset', $token),
        ];

        $this->sendTo("digtime_app_reset_password", $email, $data);
    }

    /**
     * 注册验证邮箱
     * @param \App\Mailer\User $user
     */
    public function confirmEmail(User $user)
    {
        // 模板变量
        $data = [
            'url'  => route('email.verify', ['token' => $user->confirmation_token]),
            'name' => $user->name,
        ];

        $this->sendTo("digtime_app_register", $user->email, $data);
    }

}
