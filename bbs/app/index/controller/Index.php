<?php

declare(strict_types=1);

namespace app\index\controller;

use think\Request;
use app\model\Post as PostModel;
use think\facade;
use think\Collection;
use app\validate\Post as PostValidate;
use think\exception\ValidateException;
use think\facade\Session;

class Index
{
    private $toast = 'public/toast';


    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        // dump(Session::all());
        // dump(Session::get('admin'));
        return view('/post/index', [                                                     //相对路径：目录在 view\admin下 根目录为admin.    
            'list'  => PostModel::withSearch(['postID', 'postUserID', 'postTitle', 'postContent','postTime'], [        //如果view函数的地址中 为view/public/toast ，则会访问view\admin\view\public\toast.html，符合针对根目录admin的后续访问规则。
                'postID' => request()->param('postID'),                                       //如果view函数地址 为view/public/toast.html  通过访问/admin/user.html可以成功访问到视图 模板文件存在:view/public/toast.html
                'postUserID' => request()->param('postUserID'),
                'postTitle' => request()->param('postTitle'),
                'postContent' => request()->param('postContent'),
                'postTime' => request()->param('postTime'),
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
        return view('/post/create', [

        ]);
       
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
         // $request->session();
           
         $data = $request->param();
             dump($data);
         //    dump($request->param('userRegisterTime'));
         try {
            //  validate(UserValidate::class)->scene('')->check($data);
         } catch (ValidateException $e) {
             // return $e->getError();
             return view('view/public/toast.html', [                  //目录在 view\admin下 根目录为admin  认为view函数中末尾加入了.html会转换到bbs目录下
                 'infos' => $e->getError(),
                 'url_text' => '返回上一页',
                 'url_path' => url('/index/index/create')
             ]);
         }
 
 
         //写入数据库
         $id = PostModel::create($data)->getData('postID');
 
         if ($id) {
             return view('view/public/toast.html', [
                 'infos' => '注册成功',
                 'url_text' => '去首页',
                 'url_path' => url('/index/index/')
             ]);
         } else {
             return '注册失败';
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
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        
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
    }
}
