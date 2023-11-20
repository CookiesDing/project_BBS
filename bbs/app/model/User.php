<?php

namespace app\model;

use think\Model;

class User extends Model
{
    protected $pk = 'userID';

    //一对多关联 1user -> x post
    public function post()
    {
        return $this->hasMany('post', 'postUserID', 'userID');
    }

    //一对多关联 1user -> x comment
    public function comment()
    {
        return $this->hasMany('comment', 'commentUserID', 'userID');
    }


    //userSex搜索器
    public function searchUserSexAttr($query, $value)   //代表sql查询器  代表userSex值
    {
        //如果UserSex为空
        if (empty($value)) {
            return ' ';
        } else {
            return $query->where('userSex', $value);
        }
    }

    //userName搜索器
    public function searchUserNameAttr($query, $value)   
    {
        //如果UserSex为空
        if (empty($value)) {
            return ' ';
        } else {
           return $query->where('userName','like','%'.$value.'%');
        }
    }

    //usertele搜索器
    public function searchUserTelephoneAttr($query, $value)   
    {
        //如果UserSex为空
        if (empty($value)) {
            return ' ';
        } else {
            return $query->where('userTelephone','like','%'.$value.'%');
        }
    }

   //userSex获取器
   public function getUserSexAttr( $value)  
   {
      $userSex=['male'=>'男','female'=>'女'];
      return $userSex[$value];
   }

    //userRegistetime搜索器
    public function searchUserRegisterTimeAttr($query, $value)   //代表sql查询器  代表userSex值
    {
        //如果UserSex为空
        if (empty($value)) {
            return ' ';
        } else {
            return $query->order('userRegisterTime',$value);
        }
    }

    //userID搜索器
    public function searchUserIDAttr($query, $value)   
    {
        //如果UserSex为空
        if (empty($value)) {
            return ' ';
        } else {
            return $query->order('userID',$value);
        }
    }
}
