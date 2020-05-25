<?php
    
namespace app\index\model\User;

use think\Model;
use think\Db;

class User extends Model
{
    public function user_index($username,$password)
    {
        $result = Db::name('user')->where('user_Name',$username)->find();
        if(!$result){
            return 0;//没有这个账户；
        }
        elseif($result['user_Password'] == $password){
                if($result['user_Status'] == 2)
                    return 2;//账号冻结
                elseif($result['user_Status'] == 1){
                    session('user_Id',$result['user_Id']);
                    return 1;//登录成功
                }
                else{
                    return 0;//没有这个账户；
                }
        }
        else{
            return 3;//密码错误
        }
    }
    
    public function user_register($username,$password,$email)
    {
        $result = Db::name('user')->insert(
            ['user_Name' => "$username",
            'user_Password' => "$password",
            'user_Status' => 1,
            'user_Email' => "$email"]
        );
        if($result)
            return 1;//注册成功
        else
            return 0;//注册失败
    }
}
