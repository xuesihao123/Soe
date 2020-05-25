<?php

namespace app\index\model\Admin;

use think\Model;
use think\Db;

class Admin extends Model
{
    public function admin_freeze($userId)//冻结用户
    {
        $result = Db::name('user')->where('user_Id',$userId)->update('user_Status',2);
        if($result)
            return 1;
        else
            return 0;
    }

    public function admin_logout($userId)//注销用户
    {
        $result = Db::name('user')->where('user_Id',$userId)->update('user_Status',3);
        if($result)
            return 1;
        else
            return 0;
    }

    public function admin_uodata($status,$userId)
    {
        $result = Db::name('user')->where('user_Id',$userId)->update('user_Status',$status);
        if($result)
            return 1;
        else
            return 0;
    }
}