<?php

namespace app\index\controller;

use think\Controller;
use app\index\model\Theater\theater;

class Theaterc extends Controller
{
    public function add()
    {
        $row = input('row');
        $col = input('col');
        $name = input('name');
        $add = new theater();
        $json = array();
        $json['flag'] = $add->theater_add($col,$row,$name);
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
        $json = $show->theater_show();
        return json_encode($json);
    }

    public function update()
    {
        $Id = input('theater_Id');
        $name = input('theater_Name');
        $update = new theater();
        $json = array();
        $json['flag'] = $update->theater_update($Id,$name);
        return json_encode($json); 
    }

    public function shows()
    {
        $Id = input('theater_Id');
        $shows = new theater();
        $json = $shows->theater_shows($Id);
        return json_encode($json);
    }


}