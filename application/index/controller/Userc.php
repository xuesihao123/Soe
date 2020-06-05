<?php
    
namespace app\index\controller;

use think\Controller;
use app\index\model\User\user;

class Userc extends Controller
{
    public function index()//登录
    {
        // $j = input();
        // dump($j);
        // $username = $j['username'];
        // $password = md5($j['password']);
        $username = input('username');
        $password = md5(input('password'));
        $user = new user;
        $json = array();
        $json['flag'] = $user->user_index($username,$password);
        return json_encode($json);
    }
    
    public function register()
    {
        // $j = input();
        // $username = $j['username'];
        // $password = md5($j['password']);
        // dump(input());
        $username = input('username');
        $password = md5(input('password'));
        $email = input('email');
        $user = new user;
        $json = array();
        $json['flag'] = $user->user_register($username,$password,$email);
        return json_encode($json);
    }
    
    public function password()
    {
        $userId = input('user_Id');
        $newpassword = md5(input('user_Password'));
        $password = new user();
        $json = array();
        $json['flag'] = $password->user_password($userId,$newpassword);
        return json_encode($json);
    }

}
