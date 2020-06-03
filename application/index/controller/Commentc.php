<?php

namespace app\index\controller;

use think\Controller;
use think\Cache;
use app\index\model\Comment\comment;

class Commentc extends Controller
{
    public function add()
    {
        $comment = input('comment');
        $movieId = input('movieId');
        $userId = Cache::get('Id');
        $add = new comment();
        $json = array();
        $json['flag'] = $add->comment_add($userId,$movieId,$comment);
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

    public function show()
    {
        $movieId = input('movie_Id');
        $show = new comment();
        $json = $show->comment_show($movieId);
        return json_encode($json);
    }

}