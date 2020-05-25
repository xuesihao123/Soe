<?php

namespace app\index\model\Comment;

use think\Model;
use think\Db;

class Comment extends Model
{
    public function comment_add($userId,$movieId,$comment)//添加评论
    {
        $date = date('Y-m-d H:i:s');
        $result = Db::name('comment')->insert(
            [
                'movie_Id' => $movieId,
                'user_Id' => $userId,
                'comment_Content' => "$comment",
                'comment_Date' => "$date"
            ]
            );
        if($result)
             return 1;
        else    
            return 0;
    }

    public function comment_delete($userId,$commentId)//删除评论
    {
        $result = Db::name('comment')
        ->where('user_Id',$userId)
        ->where('comment_Id',$commentId)
        ->delete();
        if($result)
            return 1;
        else
            return 0;  
    }
}