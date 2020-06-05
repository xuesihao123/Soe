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
        $time = input('time');
        $type = input('type');
        $cover = input('cover');
        $add = new movie();
        $json = array();
        $json['flag'] = $add->movie_add($name,$brief,$start,$end,$time,$type,$cover);
        return json_encode($json);
    }


    public function update()
    {
        $id = input('movie_Id');
        $name = input('movie_Name');
        $brief = input('movie_Brief');
        $start = input('movie_Start');
        $end = input('movie_End');
        $time = input('movie_Time');
        $type = input('movie_Type');
        $cover = input('movie_Cover');
        $update = new movie();
        $json = array();
        $json['flag'] = $update->movie_update($id,$name,$brief,$start,$end,$time,$type,$cover);
        return json_encode($json);
    }

    public function delete()
    {
        $movieId = input('movie_Id');
        $delete = new movie();
        $json = array();
        $json['flag'] = $delete->movie_delete($movieId);
        return json_encode($json);
    }

    public function select()
    {
        $select = new movie();
        $json = $select->movie_select();
        $json = array_reverse($json);
        return json_encode($json);
    }

    public function find()
    {
        $str = input('str');
        $find = new movie();
        $json = $find->movie_find($str);
        return json_encode($json);
    }

}