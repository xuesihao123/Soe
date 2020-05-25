<?php

namespace app\index\controller;

use think\Controller;
use app\index\model\Theater\theater;

class Theaterc extends Controller
{
    public function add()
    {
        $row = $_POST['row'];
        $col = $_POST['col'];
        $add = new theater();
        $json = array();
        $json['flag'] = $add->theater_add($col,$row);
        return json_encode($json);
    }

    public function delete()
    {
        $theaterId = $_POST['theadId'];
        $delete = new theater();
        $json = array();
        $json['flag'] = $delete->theater_delete($theaterId);
        return json_encode($json);
    }

    public function show()
    {
        $show = new theater();
        $json = $show->theater->theater_show();
        return json_encode($json);
    }
}