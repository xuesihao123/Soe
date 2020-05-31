<?php

namespace app\index\controller;

use think\Controller;
use app\index\model\Comment\comment;

class Commentc extends Controller
{
    public function add()
    {
        $comment = input('comment');
        $movieId = input('movieId');
        $userId = $_SESSION['user_Id'];
        $add = new comment();
        $json = array();
        $json['flag'] = $buy->comment_add($userId,$movieId,$comment);
        return json_encode($json);
    }

    public function delete()
    {
        $commentId = input('commentId');
        $userId = $_SESSION['user_Id'];
        $add = new comment();
        $json = array();
        $json['flag'] = $buy->comment_add($userId,$commentId);
        return json_encode($json);
    }
}