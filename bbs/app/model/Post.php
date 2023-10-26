<?php
namespace app\model;
use think\Model;

class Post extends Model
{
    protected $pk = 'postID';

    //一对多关联 1post -> x comment
    public function comment()
    {
        return $this->hasMany('comment','commentPostID','postID');
    }
}