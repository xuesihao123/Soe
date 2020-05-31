<?php

namespace app\index\controller;

use think\Controller;
use app\index\model\Admin\admin;

class Adminc extends Controller
{
    public function freeze()//冻结用户
    {
        $userId = input('user_Id');
        $freeze = new admin();
        $json = array();
        $json['flag'] = $freeze->admin_freeze($userId);
        return json_encode($json);
    }

    public function logout()
    {
        $userId = input('user_Id');
        $logout = new admin();
        $json = array();
        $json['flag'] = $freeze->admin_logout($userId);
        return json_encode($json);
    }

    public function update()
    {
        $userId = input('user_Id');
        $status = input('status');
        $update = new admin();
        $json = array();
        $json['flag'] = $freeze->admin_update($userId);
        return json_encode($json);
    }
    public function index()
    {
        // $this->success('新增成功', 'User/register');
        
        return $this->fetch('index/register');
    }
}