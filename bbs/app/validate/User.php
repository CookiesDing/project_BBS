<?php
declare (strict_types = 1);

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
        'userName|用户名'       =>      'require|chsDash|unique:user',
        'userPassword|密码'     =>      'require|min:6',
        'userTelephone|电话'        =>   'require|number',
        'userAge'               =>      'require|integer',
        
];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名' =>  '错误信息'
     *
     * @var array
     */
    protected $message = [];


       //验证场景
       protected $scene = [
        'update'  =>  ['userPassword','userEmail','userAge']
    ];
}
