<?php

namespace app\model;

use think\Model;

class index_view extends Model
{

    //      用来执行相关数据库的操作 withsearch等  SELECT * FROM `think_user` WHERE  `name` LIKE 'think%' AND `create_time`


    //postTitle搜索器
    public function searchPostTitleAttr($query, $value)
    {
        //如果UserSex为空
        if (empty($value)) {
            return ' ';
        } else {
            return $query->where('postTitle', 'like', '%' . $value . '%');
        }
    }
    //postContent搜索器
    public function searchPostContentAttr($query, $value)
    {
        //如果UserSex为空
        if (empty($value)) {
            return ' ';
        } else {
            return $query->where('postContent', 'like', '%' . $value . '%');
        }
    }
    

    //postTIme搜索器
    public function searchPostTimeAttr($query, $value)   //代表sql查询器  代表userSex值
    {
        //如果UserSex为空
        if (empty($value)) {
            return ' ';
        } else {
            return $query->order('postTime', $value);
        }
    }



    //userName搜索器
    public function searchUserNameAttr($query, $value)
    {
        //如果UserSex为空
        if (empty($value)) {
            return ' ';
        } else {
            return $query->where('userName', 'like', '%' . $value . '%');
        }
    }
}
