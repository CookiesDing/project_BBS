<?php

namespace app\model;

use think\Model;

class Post_comment_view extends Model
{

    //      用来执行相关数据库的操作 withsearch等  SELECT * FROM `think_user` WHERE  `name` LIKE 'think%' AND `create_time`
    //pPostLastReplyTime搜索器
    public function searchCommentTimeAttr($query, $value)   //代表sql查询器  代表userSex值
    {
        //如果UserSex为空
        if (empty($value)) {
            return ' ';
        } else {
            return $query->order('CommentTime', $value);         //排序
        }
    }

  
}
