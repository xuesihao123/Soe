<?php

namespace app\index\controller;

use think\Controller;
use app\index\model\Movie\movie;

class Moviec extends Controller
{
    public function add()
    {
        $name = $_POST['name'];
        $brief = $_POST['brief'];
        $start = $_POST['start'];
        $end = $_POST['end'];
        $add = new movie();
        $json = array();
        $json['flag'] = $json->movie_add($name,$brief,$start,$end);
        return json_encode($json);
    }

    public function updata()
    {
        $id = $_POST['movieId'];
        $name = $_POST['name'];
        $brief = $_POST['brief'];
        $start = $_POST['start'];
        $end = $_POST['end'];
        $update = new movie();
        $json = array();
        $json['flag'] = $json->movie_update($id,$name,$brief,$start,$end);
        return json_encode($json);
    }

    public function delete()
    {
        $movieId = $_POST['movieId'];
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