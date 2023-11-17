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
}