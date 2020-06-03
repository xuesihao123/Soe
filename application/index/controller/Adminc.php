<?php

namespace app\index\controller;

use think\Controller;
use app\index\model\Admin\admin;

class Adminc extends Controller
{
    public function freeze()//冻结用户
    {
        $userId = input('user_Id');
        $status = input('user_Status');
        $freeze = new admin();
        $json = array();
        if($status)
            $josn['flag'] = $freeze->admin_nfreeze($userId);
        else
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
        $userName = input('user_Name');
        $userEmail = input('user_Email');
        $update = new admin();
        $json = array();
        $json['flag'] = $update->admin_update($userId,$userName,$userEmail);
        return json_encode($json);
    }

    public function index()
    {
        // $this->success('新增成功', 'User/register');
        
        return $this->fetch('index/register');
    }

    public function show()
    {
        $show = new admin();
        $json = $show->admin_show();
        return json_encode($json);
    }

    public function delete()
    {
        $userId = input('user_Id');
        $delete = new admin();
        $json = array();
        $json['flag'] = $delete->admin_delete($userId);
        return json_encode($json);
    }
}