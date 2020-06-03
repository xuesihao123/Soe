<?php

namespace app\index\model\Admin;

use think\Model;
use think\Db;

class Admin extends Model
{
    public function admin_freeze($userId)//冻结用户
    {
        $result = Db::name('user')->where('user_Id',$userId)->update(['user_Status' => 2]);
        if($result)
            return 1;
        else
            return 0;
    }
    public function admin_nfreeze($userId)
    {
        $result = Db::name('user')->where('user_Id',$userId)->update(['user_Status' => 1]);
        if($result)
            return 1;
        else
            return 0;
    }

    public function admin_logout($userId)//注销用户
    {
        $result = Db::name('user')->where('user_Id',$userId)->update(['user_Status' => 3]);
        if($result)
            return 1;
        else
            return 0;
    }

    public function admin_update($userId,$userName,$userEmail)
    {
        $result = Db::name('user')->where('user_Id',$userId)->update(['user_Name' => $userName,
                                                                      'user_Email' => $userEmail]);
        if($result)
            return 1;
        else
            return 0;
    }


    public function admin_show()
    {
        $result = Db::name('user')->select();
        return $result;
    }

    public function admin_delete($userId)
    {
        $result = Db::name('user')->where('user_Id',$userId)->delete();
        if($result)
            return 1;
        else
            return 0;
    }
}