<?php

declare(strict_types=1);

namespace app\index\controller;

use think\Request;
use app\model\Post_view as PostViewModel;
use app\model\Post_comment_view as PostCommentModel;
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
        return view('/comment/index', 
        [                                                     //相对路径：目录在 view\admin下 根目录为admin.    
            'list_post' => PostViewModel::withSearch(['postID','postTitle', 'postContent', 'postTime', 'userName'], [        //如果view函数的地址中 为view/public/toast ，则会访问view\admin\view\public\toast.html，符合针对根目录admin的后续访问规则。
                'postID' => request()->param('postID'),                                       //如果view函数地址 为view/public/toast.html  通过访问/admin/user.html可以成功访问到视图 模板文件存在:view/public/toast.html
                'postTitle' => request()->param('postTitle'),
                'postContent' => request()->param('postContent'),
                'postTime' => request()->param('postTime'),
                'userName' => request()->param('userName'),        
            ]),
            
            'list_comment' => PostCommentModel::withSearch(['postID','commentContent','commentTime', 'userName'], [        //如果view函数的地址中 为view/public/toast ，则会访问view\admin\view\public\toast.html，符合针对根目录admin的后续访问规则。
                'postID' => request()->param('postID'),                                       //如果view函数地址 为view/public/toast.html  通过访问/admin/user.html可以成功访问到视图 模板文件存在:view/public/toast.html
                'commentContent' => request()->param('commentContent'),
                'commentTime' => request()->param('commentTime'),
                'userName' => request()->param('userName'),        
            ])->paginate(
                [
                    'list_rows' => 10,
                    'query' => request()->param(),
                ]
            ),

            // 'orderPostID' => request()->param('postID') == 'desc' ? 'asc' : 'desc',
            // 'orderTime' => request()->param('postTime') == 'desc' ? 'asc' : 'desc',

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
