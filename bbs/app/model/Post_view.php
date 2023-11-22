<?php

namespace app\model;

use think\Model;

class Post_view extends Model
{
    protected $pk = 'postID';

    //      用来执行相关数据库的操作 withsearch等  SELECT * FROM `think_user` WHERE  `name` LIKE 'think%' AND `create_time`


  
}
