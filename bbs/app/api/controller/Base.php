<?php
namespace app\api\controller;

use think\Response;

abstract class Base 
{

    public function __construct()
    {

    }

    protected function createJson($data, $code = 200, $msg = "success！",$type='json')
    {
        //标准json格式
        $result=[
            'data'=>$data,
            "code"=> $code,
            "msg"=> $msg
            ];      //关联数组，储存键值
           return Response::create($result,$type);  //创建response对象。   、动态响应客户端请求，并将动态生成的响应结果返回到客户端浏览器中，从服务器向用户发送输出的结果
        
    }


}