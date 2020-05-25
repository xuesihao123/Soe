<?php

namespace app\index\controller;

use think\Controller;
use app\index\model\Admin\admin;

class adminc extends Controller
{
    public function freeze()//冻结用户
    {
        $userId = $_POST['user_Id'];
        $freeze = new admin();
        $json = array();
        $json['flag'] = $freeze->admin_freeze($userId);
        return json_encode($json);
    }

    public function logout()
    {
        $userId = $_POST['user_Id'];
        $logout = new admin();
        $json = array();
        $json['flag'] = $freeze->admin_logout($userId);
        return json_encode($json);
    }

    public function update()
    {
        $userId = $_POST['user_Id'];
        $status = $_POST['status'];
        $update = new admin();
        $json = array();
        $json['flag'] = $freeze->admin_update($userId);
        return json_encode($json);
    }
}