<?php

declare(strict_types=1);

namespace app\admin\controller;

use think\Request;
use app\model\User as UserModel;
use think\facade;
use app\api\controller\User as UserApi;
use think\Collection;
use app\validate\User as UserValidate;
use think\exception\ValidateException;
use think\facade\Session;

class User
{
    private $toast='public/toast';


    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        // dump(Session::all());
        return view('/user/index', [                                                     //相对路径：目录在 view\admin下 根目录为admin.    
            'list'  => UserModel::withSearch(['userSex', 'userName', 'userTelephone','userRegisterTime','userID'], [        //如果view函数的地址中 为view/public/toast ，则会访问view\admin\view\public\toast.html，符合针对根目录admin的后续访问规则。
                'userSex' => request()->param('userSex'),                                       //如果view函数地址 为view/public/toast.html  通过访问/admin/user.html可以成功访问到视图 模板文件存在:view/public/toast.html
                'userName' => request()->param('userName'),
                'userTelephone' => request()->param('userTelephone'),
                'userRegisterTime'=> request()->param('userRegisterTime'),
                'userID'=> request()->param('userID'),
            ])->paginate(
                [
                    'list_rows' => 8,
                    'query' => request()->param(),
                ]
                ),
                'oderID' => request()->param('userID') == 'desc' ? 'asc' : 'desc',
            'orderTime' => request()->param('userRegisterTime') == 'desc' ? 'asc' : 'desc',
         
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
        //
        $data = $request->param();
        //    dump($data);
        //    dump($request->param('userRegisterTime'));
        try {
            validate(UserValidate::class)->scene('register')->check($data);
        } catch (ValidateException $e) {
            // return $e->getError();
            return view('view/public/toast.html', [                  //目录在 view\admin下 根目录为admin  认为view函数中末尾加入了.html会转换到bbs目录下
                'infos' => $e->getError(),
                'url_text' => '返回上一页',
                'url_path' => url('/admin/user/create')
            ]);
        }

        //密码加密
        $data['userPassword'] = sha1($data['userPassword']);
        //写入数据库
        $id = UserModel::create($data)->getData('userID');

        if ($id) {
            return view('view/public/toast.html', [
                'infos' => '注册成功',
                'url_text' => '去首页',
                'url_path' => url('/admin/user/')
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
        //
        return view('edit', [
            'obj'=>UserModel::find($id)
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
        //    dump($request->param('userRegisterTime'));
        try {
            validate(UserValidate::class)->scene('update')->check($data);
        } catch (ValidateException $e) {
            // return $e->getError();
            return view('view/public/toast.html', [                  //目录在 view\admin下 根目录为admin  认为view函数中末尾加入了.html会转换到bbs目录下
                'infos' => $e->getError(),
                'url_text' => '返回上一页',
                'url_path' => url('/admin/user/'.$id.'/edit')
            ]);
        }
       

        //如有密码，则写入
        if(!empty($data['newpasswordnot'])) {
        $data['userPassword']=sha1($data['newpasswordnot']);
        }


        //  dd($data);
        $id=UserModel::update($data)->getData('userID');

        if ($id) {
            return view('view/public/toast.html', [
                'infos' => '修改成功',
                'url_text' => '去首页',
                'url_path' => url('/admin/user/')
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
        if (UserModel::destroy($id)) {
            return view('view/public/toast.html', [
                'infos' => '删除成功',
                'url_text' => '去首页',
                'url_path' => url('/admin/user/')        //传递给view模板，按照http://127.0.0.1:8000/处理。
            ]);
        } else {
            return '删除失败';
        }
    }
}
