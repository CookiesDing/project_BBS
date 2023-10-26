<?php
declare (strict_types = 1);

namespace app\controller;
use think\Request;
use app\model\Post as PostModel;
use think\facade\Validate;
use app\validate\Post as PostValidate;

class Post extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //返回所有用户参数
        $data = PostModel::select();                           
        if ($data->isEmpty()) {
            return Base::createJson([], 400, 'error');       
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
            validate(PostValidate::class)->scene('')->check($data);
        } catch (\Exception $e) {
            return Base::createJson([], 400, $e->getMessage());
        }

        //注册并返回帖子主键
        $id = PostModel::create($data)->getData('postID');

        //判断是否正常返回
        if ($id) {
            return Base::createJson($id, 200, '成功发帖！');
        } else {
            return Base::createJson([], 400, '发帖失败！');
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
              if (!Validate::isInteger($id)) {                             
                return  $this->createJson([], 400, '输入不是整数！');
            }
    
            //获取数据
            $data = PostModel::find($id);
    
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
            validate(PostValidate::class)->scene('')->check($data);
        } catch (\Exception $e) {
            return Base::createJson([], 400, $e->getMessage());
        }

        //开始更改
        $id = PostModel::update($data)->getData('postID');

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
        //
        //判断id是否为整数
        if (!Validate::isInteger($id)) {
            return  $this->createJson([], 400, '输入不是整数！');
        }

        //删除
        try {
            PostModel::find($id)->delete();
            return Base::createJson([], 200, '成功删除');
        } catch (\Error $e) {
          //  echo $e->getMessage();
            return Base::createJson([], 400, '找不到该数据');
        }
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
            $data = PostModel::find($id)->comment()->select();           //post返回hasmany类，不是NULL

            //判断是否为空
            if ($data->isEmpty()) {
                return Base::createJson([], 200, '帖子没有被回复过！');
            } else {
                return Base::createJson($data, 200, 'sucess');
            }
        } catch (\Error $e) {

            return Base::createJson([], 400, '不存在该帖子！');
        }

        // if ($data->isEmpty()) {
        //     return Base::createJson([], 400, '找不到任何数据！');       
        // } else {
        //     return Base::createJson($data, 200, 'sucess');
        // }
    }
}
