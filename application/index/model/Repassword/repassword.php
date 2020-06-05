<?php
namespace app\index\model\Repassword;
use think\Model;
use PHPMailer\SendEmail;
use think\Db;

class repassword extends Model
{
    public function repassword_update($address)
    {   
        $token = $this->genToken();
        $send = new SendEmail();
        $t = time()+600;//时间戳，判断过期
        // $time = date("Y-m-d H:i:s",strtotime("+10 minute"));
        $year = date("Y");
        $url = "127.0.0.1:9002/#/find?token=$token";
        $title = "【SOE星光剧场】找回您的账户密码";//邮件标题
        $message = "<html>亲爱的用户：您好！<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;您收到这封这封电子邮件是因为您申请了一个新的剧院系统登录密码。假如这不是您本人所申请, 请不用理会这封电子邮件, 但是如果您持续收到这类的信件骚扰, 请您尽快联络管理员。<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;要使用新的密码, 请使用以下链接启用密码。<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='$url'>{$url}</a><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(如果无法点击该URL链接地址，请将它复制并粘帖到“您申请忘记密码功能的浏览器”的地址输入框，然后单击回车即可。)<br><br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;注意:请您在收到邮件10分钟内使用，否则该链接将会失效。<br><br>
        <center>{$year}  &copy;  SOE星光剧场</center></html>";//邮件内容
        $r = Db::name('repassword')->insert(
            [
                'repassword_Token' => $token,
                'user_Email' => $address,
                'repassword_Time' => $t
            ]);
        $result = $send->SendEmail($title,$message,$address);
        if($result)
                return 1;
        return 0;
    }

    
    /**
	 * 生成随机token
	 */
	function genToken( $len = 32, $md5 = true ) {  
		# Seed random number generator  
		   # Only needed for PHP versions prior to 4.2  
		   mt_srand( (double)microtime()*1000000 );  
		   # Array of characters, adjust as desired  
		   $chars = array(  
			   'Q', '@', '8', 'y', '%', '^', '5', 'Z', '(', 'G', '_', 'O', '`',  
			   'S', '-', 'N', '<', 'D', '{', '}', '[', ']', 'h', ';', 'W', '.',  
			   '/', '|', ':', '1', 'E', 'L', '4', '&', '6', '7', '#', '9', 'a',  
			   'A', 'b', 'B', '~', 'C', 'd', '>', 'e', '2', 'f', 'P', 'g', ')',  
			   '?', 'H', 'i', 'X', 'U', 'J', 'k', 'r', 'l', '3', 't', 'M', 'n',  
			   '=', 'o', '+', 'p', 'F', 'q', '!', 'K', 'R', 's', 'c', 'm', 'T',  
			   'v', 'j', 'u', 'V', 'w', ',', 'x', 'I', '$', 'Y', 'z', '*'  
		   );  
		   # Array indice friendly number of chars;  
		   $numChars = count($chars) - 1; $token = '';  
		   # Create random token at the specified length  
		   for ( $i=0; $i<$len; $i++ )  
			   $token .= $chars[ mt_rand(0, $numChars) ];  //获取$chars中的32位随机数
		   # Should token be run through md5?  
		   if ( $md5 ) {  
			   # Number of 32 char chunks  
			   $chunks = ceil( strlen($token) / 32 ); $md5token = '';  //ceil是返回一个不小于参数的一个整数
			   # Run each chunk through md5  
			   for ( $i=1; $i<=$chunks; $i++ )  
				   $md5token .= md5( substr($token, $i * 32 - 32, 32) );  
			   # Trim the token  
			   $token = substr($md5token, 0, $len);  //截取32位随机数
		   } return $token;  
       }  
       
       public function repassword_solve($token,$password)
       {
           $result = Db::name('repassword')->where('repassword_Token',$token)->find();
           if($result)
           {
                $time = time();
                if($time < $result['repassword_Time'])
                {
                    $email = $result['user_Email'];
                     $result = Db::name('user')->where('user_Email',$email)->update(['user_Password' => $password]);
                    if($result)
                        return 1;
                    else
                        return 0;
                }
                else
                {
                    return 3;//超时
                }
           }
           else
           {
               return 4;//重新申请
           }
       }
}
