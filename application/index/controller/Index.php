<?php
namespace app\index\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {
        // $this->success('新增成功', 'User/register');
        
        return $this->fetch('index/index');
    }
}
