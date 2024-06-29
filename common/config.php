<?php

require_once("siteinfo.php");

/***********************************
 *                                 *
 *       以下配置不需要修改        *
 *                                 *
 ***********************************/
$conn = mysqli_connect(DATABASE[0],DATABASE[1],DATABASE[2],DATABASE[3]);
$conns = mysqli_connect(DATABASE[0],DATABASE[1],DATABASE[2],"information_schema");


define("EMAILAPI", URL . "email/emailsend.php");

/*
  function
*/
if ($HTTP_SERVER_VARS["HTTP_X_FORWARDED_FOR"])
{
    $ip = $HTTP_SERVER_VARS["HTTP_X_FORWARDED_FOR"];
}
elseif ($HTTP_SERVER_VARS["HTTP_CLIENT_IP"])
{
    $ip = $HTTP_SERVER_VARS["HTTP_CLIENT_IP"];
}
elseif ($HTTP_SERVER_VARS["REMOTE_ADDR"])
{
    $ip = $HTTP_SERVER_VARS["REMOTE_ADDR"];
}
elseif (getenv("HTTP_X_FORWARDED_FOR"))
{
    $ip = getenv("HTTP_X_FORWARDED_FOR");
}
elseif (getenv("HTTP_CLIENT_IP"))
{
    $ip = getenv("HTTP_CLIENT_IP");
}
elseif (getenv("REMOTE_ADDR"))
{
    $ip = getenv("REMOTE_ADDR");
}
else
{
    $ip = "Unknown";
}
//获取用户ip

function is_email($user_email)
{
    $chars = "/^([a-z0-9+_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]{2,6}\$/i";
    if (strpos($user_email, '@') !== false && strpos($user_email, '.') !== false)
    {
        if (preg_match($chars, $user_email)){
            return true;
        }
        else{
            return false;
        }
   }
   else{
            return false;
        }
}
//邮箱合法性

$ban = array(
  "1.1.1.2" => "ban"
);
//ban用户数据库

function emailsend($sendto,$topic,$content) {
  $data = array (
    'key' => EMAIL_SET['key'],
    'sendto' => $sendto,
    'topic' => $topic,
    'content' => $content,
    'name' => EMAIL_SET['name']
  );
  $ch = curl_init ();
  curl_setopt ($ch, CURLOPT_URL, EMAILAPI);
  curl_setopt ($ch, CURLOPT_POST, 1);
  curl_setopt ($ch, CURLOPT_HEADER, 0);
  curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt ($ch, CURLOPT_POSTFIELDS, $data);
  $return = curl_exec ($ch);
  curl_close ($ch);
  $arr = json_decode($return, true);
  //获取返回值
  return $arr;
}
//邮件发送

    
?>
