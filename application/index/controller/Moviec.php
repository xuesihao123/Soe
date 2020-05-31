<?php

namespace app\index\controller;

use think\Controller;
use app\index\model\Movie\movie;

class Moviec extends Controller
{
    public function add()
    {
        $name = input('name');
        $brief = input('brief');
        $start = input('start');
        $end = input('end');
        $add = new movie();
        $json = array();
        $json['flag'] = $json->movie_add($name,$brief,$start,$end);
        return json_encode($json);
    }

    public function updata()
    {
        $id = input('movieId');
        $name = input('name');
        $brief = input('brief');
        $start = input('start');
        $end = input('end');
        $update = new movie();
        $json = array();
        $json['flag'] = $json->movie_update($id,$name,$brief,$start,$end);
        return json_encode($json);
    }

    public function delete()
    {
        $movieId = input('movieId');
        $delete = new movie();
        $json = array();
        $json['flag'] = $json->movie_delete($movieId);
        return json_encode($json);
    }

    public function select()
    {
        $select = new movie();
        $json = $select->movie_select();
        $json = array_reverse($json);
        return json_encode($json);
    }
}