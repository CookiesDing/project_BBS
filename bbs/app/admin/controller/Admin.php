<?php

namespace app\admin\controller;
use app\model\Admin as AdminModel;
use app\validate\User as UserValidate;
use think\facade\Session;
use think\Request;
use think\exception\ValidateException;
class Admin
{
     /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        return view('/admin/index', [                                                     //相对路径：目录在 view\admin下 根目录为admin.    
            'list'  => AdminModel::withSearch(['adminID', 'adminName', 'adminPassword'], [        //如果view函数的地址中 为view/public/toast ，则会访问view\admin\view\public\toast.html，符合针对根目录admin的后续访问规则。
                'adminID' => request()->param('adminID'),                                       //如果view函数地址 为view/public/toast.html  通过访问/admin/user.html可以成功访问到视图 模板文件存在:view/public/toast.html
                'adminName' => request()->param('adminName'),
                'adminPassword' => request()->param('adminPassword'),     
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
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $loggedInUserId = Session::get('adminID');
        if ($id != $loggedInUserId) {
            return view('view/public/toast.html', [                  //目录在 view\admin下 根目录为admin  认为view函数中末尾加入了.html会转换到bbs目录下
                'infos' => '无法修改其他管理员的信息',
                'url_text' => '返回上一页',
                'url_path' => url('/admin/admin')
            ]);
        }
        return view('edit', [
            'obj' => AdminModel::find($id)
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
         //  dump($data);
        try {
            validate(UserValidate::class)->scene('update')->check($data);
        } catch (ValidateException $e) {
            // return $e->getError();
            return view('view/public/toast.html', [                  //目录在 view\admin下 根目录为admin  认为view函数中末尾加入了.html会转换到bbs目录下
                'infos' => $e->getError(),
                'url_text' => '返回上一页',
                'url_path' => url('/admin/admin/' . $id . '/edit')
            ]);
        }


          //dd($data);
           //如有密码，则写入
           if(!empty($data['newpasswordnot'])) {
            $data['adminPassword']=$data['newpasswordnot'];
            }

        $id = AdminModel::update($data)->getData('adminID');

        if ($id) {
            return view('view/public/toast.html', [
                'infos' => '修改成功',
                'url_text' => '去首页',
                'url_path' => url('/admin/admin/')
            ]);
        } else {
            return '修改失败';
        }
    }

}