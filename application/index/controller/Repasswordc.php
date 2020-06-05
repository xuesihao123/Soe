<?php

namespace app\index\controller;

use think\Controller;
use app\index\model\Repassword\repassword;

class Repasswordc extends Controller
{
	// function WSTVerify(){
	// 	$Verify = new \verify\Verify();
	// 	$Verify->length = 4; //验证码位数
	// 	//$Verify->expire = 1800;
	// 	//$Verify->useZh= false; //中文验证码字符串
	// 	//$Verify->fontSize= 15; //验证码字体大小(px)
	// 	//$Verify->useCurve= true; //是否画混淆曲线
	// 	//$Verify->useNoise= true; //是否添加杂点
	// 	//$Verify->imageH= true; //是否添加杂点
	// 	//$Verify->imageW= true; //是否添加杂点
	// 	//$Verify->reset= true; //验证成功后是否重置
	// 	$Verify->entry();
	// 	}
	public function forget()
	{
		$address = input('email');
		$forget = new repassword();
		$flag = $forget->repassword_update($address);
		$json = false;
		if($flag)
		{	
			$json = true;
			return json_encode($json);
		}
		return json_encode($json);
	}

	public function solve()
	{
		$password = md5(input('password'));
		$token = input('token');
		$json = array();
		$solve = new repassword();
		$json['flag'] = $solve->repassword_solve($token,$password);
		return json_encode($json);
	}
}