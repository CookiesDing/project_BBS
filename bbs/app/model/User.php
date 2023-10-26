<?php
namespace app\model;
use think\Model;

class User extends Model
{
    protected $pk = 'userID';

    //一对多关联 1user -> x post
    public function post()
    {
        return $this->hasMany('post','postUserID','userID');
    }

    //一对多关联 1user -> x comment
    public function comment()
    {
        return $this->hasMany('comment','commentUserID','userID');
    }
}