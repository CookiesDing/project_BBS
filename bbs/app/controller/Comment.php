<?php
declare (strict_types = 1);

namespace app\controller;
use think\Request;
use app\model\Comment as CommentModel;
use app\validate\Comment as CommentValidate;

class Comment extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
        echo'hah';
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
            validate(CommentValidate::class)->scene('')->check($data);
        } catch (\Exception $e) {
            return Base::createJson([], 400, $e->getMessage());
        }

        //注册并返回帖子主键
        $id = CommentModel::create($data)->getData('commentID');

        //判断是否正常返回
        if ($id) {
            return Base::createJson($id, 200, '成功回复！');
        } else {
            return Base::createJson([], 400, '回复失败！');
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
        //
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
        //
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
    }
}
