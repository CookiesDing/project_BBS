<?php
namespace app\model;

use app\model\User;
use think\Model;

class Post extends Model
{
    protected $pk = 'postID';

    //一对一关联 1post->1 user
    public function user()
    {
        return $this->HasOne(User::class,'userID','postUserID');
    }
    //一对多关联 1post -> x comment
    public function comment()
    {
        return $this->hasMany('comment','commentPostID','postID');
    }

      //postID搜索器        用来执行相关数据库的操作 withsearch等  SELECT * FROM `think_user` WHERE  `name` LIKE 'think%' AND `create_time`
      public function searchPostIDAttr($query, $value)   
      {
         
          if (empty($value)) {
              return ' ';
          } else {
              return $query->order('postID',$value);        //排序
          }
      }


          //userRegistetime搜索器
    public function searchPostTimeAttr($query, $value)   //代表sql查询器  代表userSex值
    {
        //如果UserSex为空
        if (empty($value)) {
            return ' ';
        } else {
            return $query->order('postTime',$value);         //排序
        }
    }

      //postTitle搜索器
      public function searchPostTitleAttr($query, $value)   
      {
          //如果UserSex为空
          if (empty($value)) {
              return ' ';
          } else {
             return $query->where('postTitle','like','%'.$value.'%');   //搜索
          }
      }

            //userRegistetime搜索器
    public function searchPostContentAttr($query, $value)   //代表sql查询器  代表userSex值
    {
        //如果UserSex为空
        if (empty($value)) {
            return ' ';
        } else {
            return $query->where('postContent','like','%'.$value.'%');   //搜索
        }
    }
    public function searchPostUserIDAttr($query, $value)   //代表sql查询器  代表userSex值
    {
        //如果UserSex为空
        if (empty($value)) {
            return ' ';
        } else {
            return $query->where('postUserID','like','%'.$value.'%');   //搜索
        }
    }


}