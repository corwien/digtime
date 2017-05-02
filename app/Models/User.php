<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Mail;
use App\Mailer\UserMailer;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','avatar','confirmation_token','phone','api_token', 'settings'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * 该字段将会自动en/decode json
     * @var array
     */
    /*
    protected $casts = [
        'settings' => 'array'
    ];
    */

    /**
     * 重写重置密码的邮件发送通知，覆盖zhihu_app_reset_password底层的发送方法
     * 对这个类进行重写： \Illuminate\Contracts\Auth\PasswordBroker
     *  $user->sendPasswordResetNotification(
     *   $this->tokens->create($user)
     *   );
     * 类文件：Passwords\PasswordBroker
     * @param $token
     */
    public function sendPasswordResetNotification($token)
    {
        // 重构发送邮件
        (new UserMailer())->resetPassword($token, $this->email);
    }



}
