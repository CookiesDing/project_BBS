<?php
namespace app\model;
use think\Model;

class Comment extends Model
{
    protected $pk = 'commentID';
    //commentID
    public function searchCommentIDAttr($query, $value)   //代表sql查询器  代表userSex值
    {
        //如果UserSex为空
        if (empty($value)) {
            return ' ';
        } else {
            return $query->where('commentID','=',$value);   //搜索
        }
    }

    public function searchCommentPostIDAttr($query, $value)   //代表sql查询器  代表userSex值
    {
        //如果UserSex为空
        if (empty($value)) {
            return ' ';
        } else {
            return $query->where('commentPostID','=',$value);   //搜索
        }
    }

    public function searchCommentUserIDAttr($query, $value)   //代表sql查询器  代表userSex值
    {
        //如果UserSex为空
        if (empty($value)) {
            return ' ';
        } else {
            return $query->where('commentUserID','=',$value);   //搜索
        }
    }

    public function searchCommentContentAttr($query, $value)   //代表sql查询器  代表userSex值
    {
        //如果UserSex为空
        if (empty($value)) {
            return ' ';
        } else {
            return $query->where('commentContent','like','%'.$value.'%');   //搜索
        }
    }
}