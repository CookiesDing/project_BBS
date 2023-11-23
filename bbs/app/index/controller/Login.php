<?php

namespace app\index\controller;
use app\model\User as UserModel;
use app\Request;
use think\facade\Session;
use think\facade\Validate;

class Login
{
    public function index()
    {
        return view('/login/index');
    }
    public function check(Request $request)
    {
        //   dd($request->all());

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
                'userPassword' => sha1($data['userPassword']),
                // dd(sha1($data['userPassword']))
            ]

        );
        // dd($request->all());

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
                'url_path' => url('/index/login/')
            ]);
        } else {
            $user=UserModel::where('userName', $data['userName'])->find();
            // return json($user);
            session('user', $data['userName']);
            session('userID', $user['userID']);
            return redirect('/index/index');
            // dump(Session::all());
        }
    }

    public function out()
    {
        session('user', null);
        session('userID', null);
        return redirect('/index/index/');
    }
}
