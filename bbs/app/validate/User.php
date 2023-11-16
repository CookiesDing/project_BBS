<?php

declare(strict_types=1);

namespace app\validate;

use think\Validate;

class User extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名' =>  ['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        "token" => "token",
        'userName|用户名'       =>      'require|chsDash|unique:user',
        'userPassword|密码'     =>      'require|min:6',
        'userPasswordNot|密码验证'     =>      'require|confirm:userPassword',
        'userTelephone|电话'        =>   'number',
        'userAge|年龄'               =>      'integer',
        'agree|协议'         =>             'require|accepted',
        'newpassword|新密码'=>'min:6',
        'newpasswordnot|密码确认'    => 'min:6|requireWith:newpassword|confirm:newpassword',
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名' =>  '错误信息'
     *
     * @var array
     */
    protected $message = [

        'agree.require'         =>             '你需要同意协议才能通过！',
    ];


    //验证场景
    protected $scene = [
        'update'  =>  ['newpassword','newpasswordnot', 'userTelephone', 'userAge'],
        'register'  =>  ['userName', 'userPassword', 'userPasswordNot', 'agree','token']

    ];
}
