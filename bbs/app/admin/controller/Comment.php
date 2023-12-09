<?php

declare(strict_types=1);

namespace app\admin\controller;

use think\Request;
use app\model\Comment as CommentModel;
use think\facade;
use think\Collection;
use app\validate\Comment as CommentValidate;
use think\exception\ValidateException;

class Comment
{
    private $toast = 'public/toast';


    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        return view('/comment/index', [                                                     //相对路径：目录在 view\admin下 根目录为admin.    
            'list'  => CommentModel::withSearch(['commentID', 'commentPostID', 'commentUserID', 'commentContent','commentTime'], [        //如果view函数的地址中 为view/public/toast ，则会访问view\admin\view\public\toast.html，符合针对根目录admin的后续访问规则。
                'commentID' => request()->param('commentID'),                                       //如果view函数地址 为view/public/toast.html  通过访问/admin/user.html可以成功访问到视图 模板文件存在:view/public/toast.html
                'commentPostID' => request()->param('commentPostID'),
                'commentUserID' => request()->param('commentUserID'),
                'commentContent' => request()->param('commentContent'),
                'commentTime' => request()->param('commentTime'),        
            ])->paginate(
                [
                    'list_rows' => 8,
                    'query' => request()->param(),
                ]
            ),
            'orderPostID' => request()->param('postID') == 'desc' ? 'asc' : 'desc',
            'orderTime' => request()->param('postTime') == 'desc' ? 'asc' : 'desc',

        ]);
        
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
        return view('create', []);
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
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
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        return view('edit', [
            'obj' => CommentModel::find($id)
        ]);
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
           $data = $request->param();
             dump($data);
          try {
              validate(CommentValidate::class)->scene('')->check($data);
          } catch (ValidateException $e) {
            //   return $e->getError();
              return view('view/public/toast.html', [                  //目录在 view\admin下 根目录为admin  认为view函数中末尾加入了.html会转换到bbs目录下
                  'infos' => $e->getError(),
                  'url_text' => '返回上一页',
                  'url_path' => url('/admin/comment/' . $id . '/edit')
              ]);
          }
  
  
            // dd($data);
          $id = CommentModel::update($data)->getData('commentID');
          $postid=$request->param('commentPostID');
        //   '/index/comment/?postID='.$postid.''

          if ($id) {
              return view('view/public/toast.html', [
                  'infos' => '修改成功',
                  'url_text' => '回到上一级',
                  'url_path' => url('/admin/comment/?commentPostID='.$postid.'')
              ]);
          } else {
              return '修改失败';
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

       
         if (CommentModel::destroy($id)) {
            return view('view/public/toast.html', [
                'infos' => '删除成功',
                'url_text' => '回到首页',
                'url_path' => url('/admin/comment/')        //传递给view模板，按照http://127.0.0.1:8000/处理。
            ]);
        } else {
            return '删除失败';
        }
    }
}
