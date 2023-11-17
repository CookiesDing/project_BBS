<?php

namespace app\admin\controller;
use app\model\User as UserModel;
use app\Request;
use think\facade\Validate;

class Login
{
    public function index()
    {
        return view('/login/index');
    }
    public function check(Request $request)
    {
       

        //获得数据
        $data = $request->param();

        //错误集合
        $errors = [];

        //验证用户名或密码
        $validate = Validate::rule([
            'userName|用户名' => 'unique:user,userName^userPassword',
        ]);
        $result = $validate->check(
            [
                'userName' => $data['userName'],
                'userPassword' => $data['userPassword'],
            ]

        );

        ///用户名验证
        if ($result) {
            $errors[] = '用户名或密码不正确~';
        }
        //验证码验证
        if (!captcha_check($data['code'])) {
            $errors[] = '验证码不正确~';
        }

        //判断是否有错误
        if (!empty($errors)) {
            return view('view/public/toast.html', [
                'infos' => $errors[0],
                'url_text' => '返回登陆',
                'url_path' => url('/admin/login/')
            ]);
        } else {
            $user=UserModel::where('userName', $data['userName'])->find();
            return json($user);
            // session('userID', $data['userID']);
            session('admin', $data['userName']);
            
            return redirect('/admin/user');
        }
    }

    public function out()
    {
        session('admin', null);
        session('userID', null);
        return redirect('/admin/login/');
    }
}
