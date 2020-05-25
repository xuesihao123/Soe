<?php
    
namespace app\index\controller;

use think\Controller;
use app\index\model\User\user;

class Userc extends Controller
{
    public function index()//登录
    {
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $user = new user;
        $json = array();
        $json['flag'] = $user->user_index($username,$password);
        return json_encode($json);
    }
    
    public function register()
    {
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $email = $_POST['email'];
        $user = new user;
        $json = array();
        $json['flag'] = $user->user_register($username,$password,$email);
        dump($json);
        return json_encode($json);
    }
}
