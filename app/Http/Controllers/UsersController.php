<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use EasyWeChat\Foundation\Application;

class UsersController extends Controller
{
    public $wechat;

    public function __construct(Application $wechat)
    {
        $this->wechat = $wechat;
    }

    public function show($user_id)
    {
        // 获取用户信息
        $user = User::findOrFail($user_id);
        // $url = route('profile', ['user_id' => $user_id]);
        // dd($url);
        // "http://digtime.app/user/4"
        // dispatch(new sendReminderEmail($user));

        return view('users.show', compact('user'));
    }

    public function avatar()
    {
        return view('users.avatar');
    }

    /**
     * 头像上传保存到本地服务器
     */
    public function avatarUpload(Request $request)
    {
        // 获取图片文件对象
        $file = $request->file('img');

        // 文件名
        $filename = md5(time().user()->id) . '.' . $file->getClientOriginalExtension();

        // 将图片保存到本地
        $file->move(public_path('avatars'), $filename);

        // 修改用户的头像
        // user()->avatar = asset(public_path('avatars/'.$filename));
        user()->avatar = '/avatars/'.$filename; // 相对路径

        user()->save();

        return ['url' => user()->avatar];
    }

    public function users()
    {
        $users = $this->wechat->user->lists();

        return $users;
    }

    public function user($openId)
    {
        $user = $this->wechat->user->get($openId);

        return $user;
    }
}
