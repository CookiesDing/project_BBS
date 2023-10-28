<?php

declare(strict_types=1);

namespace app\api\controller;

use think\Request;
use app\model\User as UserModel;
use think\exception\ValidateException;
use think\facade\Validate;
use app\validate\User as UserValidate;
use think\db\Fetch;

class User extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {   
       
        //返回所有用户参数
        $data = UserModel::select();                           //一般我们在浏览器输入一个网址访问网站都是GET请求   select返回数据集
        if ($data->isEmpty()) {
            return Base::createJson([], 400, 'error');         //等价于this->createJson([],400,'error');  静态访问使用 class:function()。实例化后$a->function()
        } else {
            return Base::createJson($data, 200, 'sucess');
        }
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //获取数据
        $data = $request->param();

        //验证器验证
        try {
            validate(UserValidate::class)->scene('')->check($data);
        } catch (\Exception $e) {
            return Base::createJson([], 400, $e->getMessage());
        }

        //注册并返回账号
        $id = UserModel::create($data)->getData('userName');

        //判断是否正常返回
        if ($id) {
            return Base::createJson($id, 200, '成功注册！');
        } else {
            return Base::createJson([], 400, '注册失败！');
        }
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //判断id是否为整数
        if (!Validate::isInteger($id)) {                             //出现问题： Column not found: 1054 Unknown column 'id' in 'where clause'  发现因为数据库模型下没有设置主键
            return  $this->createJson([], 400, '输入不是整数！');
        }

        //获取数据
        $data = UserModel::find($id);

        //判断数据是否有效
        if (empty($data)) {
            return Base::createJson([], 400, '未找到该数据');
        } else {
            return Base::createJson($data, 200, 'success');
        }
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //获取数据
        $data = $request->param();

        //验证器验证
        try {
            validate(UserValidate::class)->scene('update')->check($data);
        } catch (\Exception $e) {
            return Base::createJson([], 400, $e->getMessage());
        }

        //开始更改
        $id = UserModel::update($data)->getData('userName');

        //判断是否正常返回
        if ($id) {
            return Base::createJson($id, 200, '成功更改！');
        } else {
            return Base::createJson([], 400, '更改失败！');
        }
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //判断id是否为整数
        if (!Validate::isInteger($id)) {
            return  $this->createJson([], 400, '输入不是整数！');
        }

        //删除
        try {
            UserModel::find($id)->delete();
            return Base::createJson([], 200, '成功删除');
        } catch (\Error $e) {
           // echo $e->getMessage();
            return Base::createJson([], 400, '找不到该数据');
        }
    }


    public function post($id)
    {
        //判断id是否为整数
        if (!Validate::isInteger($id)) {
            return  $this->createJson([], 400, '输入不是整数！');
        }

        //获取关联模型下的信息
        try {

            //获取数据
            $data = UserModel::find($id)->post()->select();           //post返回hasmany类，不是NULL

            //判断是否为空
            if ($data->isEmpty()) {
                return Base::createJson([], 400, '用户没有发过帖子！');
            } else {
                return Base::createJson($data, 200, 'sucess');
            }
        } catch (\Error $e) {

            return Base::createJson([], 400, '找不到该用户数据！');
        }

        // if ($data->isEmpty()) {
        //     return Base::createJson([], 400, '找不到任何数据！');       
        // } else {
        //     return Base::createJson($data, 200, 'sucess');
        // }
    }

    public function comment($id)
    {
        echo 'test';
        //判断id是否为整数
        if (!Validate::isInteger($id)) {
            return  $this->createJson([], 400, '输入不是整数！');
        }

        //获取关联模型下的信息
        try {
            $data = UserModel::find($id)->comment()->select();           //post返回hasmany类，不是NULL

            //判断是否为空
            if ($data->isEmpty()) {
                return Base::createJson([], 200, '用户没有评论过！');
            } else {
                return Base::createJson($data, 200, 'sucess');
            }
        } catch (\Error $e) {

            return Base::createJson([], 400, '找不到该用户数据！');
        }

        // if ($data->isEmpty()) {
        //     return Base::createJson([], 400, '找不到任何数据！');       
        // } else {
        //     return Base::createJson($data, 200, 'sucess');
        // }
    }
}
