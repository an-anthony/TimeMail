<?php

require_once('./common/config.php');

if (empty($_POST['time']) || empty($_POST['content']) || empty($_POST['email']) || empty($_POST['topic']) || empty($_POST['captcha']) || empty($_POST['publish'])) {
    echo "你漏填消息啦o_o ....";
    exit();
}

if(!empty($ban[$ip]))
{
    echo "呀!你的IP被封禁了";
    exit();
}

$time = $_POST['time'];

$time = strtotime($time);
if(!$time){
    echo "暂不可以使用火星时间哦~";
    exit();
}

$content =  htmlentities($_POST['content']);;
$email = htmlentities($_POST['email']);
$topic = htmlentities($_POST['topic']);
$captcha = $_POST['captcha'];
$publish = $_POST['publish'] === 'true'? 1 : 0;

require_once ('./api/captcha/captcha_util.php');
if(!validateCaptcha($captcha)){
    echo "验证码有误，再检查检查（。＾▽＾）";
    exit();
}
if (strlen($content) > 15000) {
  echo "您发送的邮件内容超过了15000字，短点呗？";
  exit();
}
if (strlen($topic) > 500) {
  echo "您发送的邮件标题超过了长度限制!";
  exit();
}
if(!is_email($email))
{
  echo "邮箱输错啦，再仔细看看👀";
  exit();
}
if(strlen($content) < 20)
{
  echo "信件内容太少了,再写点内容吧😊!";
  exit();
}

if (!empty($ip)) {

  $sql = "SELECT * FROM `checking` where ip = '$ip'";
  $commd = mysqli_query($conn,$sql);
  $result_checking = mysqli_fetch_assoc($commd);

  if (!empty($result_checking) || !empty($result_waiting)) {
    if (($time - $result_checking['time']) <= 3600*24 || ($time - $result_waiting['time']) <= 3600*24) {
      echo "每24小时只能投递一次哦!";
      exit();
    }
  }
}

//timenow->发信时间戳  time->收信时间戳  timereal->完整时间戳
$timenow = strtotime(date("Y-m-d H:i:s",time()));
$timereal = time();

//判断收信时间与当前时间先后
if($time <= $timenow)
{
  echo "请填写一个将来的时间!";
  exit();
}

$conn->begin_transaction();

$uuid = uniqid("",true); // 生成用户编号

//do{
//    $code = null;
//    $str = "17hj0q5rtyzxcv89bn34o6sdfguiwepa2klm";
//    $max = strlen($str)-1;
//    for ($i = 0;$i < 50; $i++) {
//        $code.= $str[rand(0,$max)];
//    }
//
//    $sql = "SELECT COUNT(uid) FROM `check` where code='$code'";
//    $commd = mysqli_query($conn,$sql);
//    $result_check = mysqli_fetch_assoc($commd);
//
//
//} while($result_check['count'] < 0);

$code = $uuid; // 也不知道为什么要code
$stmt = $conn->prepare("INSERT INTO `check` (`uid`, `code`, `time`) VALUES (?, ?, ?)");
$stmt->bind_param('sss', $uuid, $code, $timereal);

if(!$stmt->execute()){
    echo("无法生成身份认证码,请联系网站管理员处理!");
    exit();
}

$stmt = $conn->prepare("INSERT INTO `checking` (`uid`, `topic`, `content`, `email`, `from`, `to`, `ip`,`publish`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssi", $uuid,$topic,$content,$email,$timenow,$time,$ip,$publish);

if(!$stmt->execute()){
    echo("无法保存邮件,请联系网站管理员处理!");
    exit();
}


$urll = URL . "check.php?c=$code";

$html = "
<h2 style='color: #333333;'>🎉欢迎使用".TITLE." 🎉</h2>
<p style='font-family: Arial, sans-serif; font-size: 14px; color: #333333; line-height: 1.6;'>我们发送这封验证邮件以确认是您本人使用时光邮局。</p>
<p style='font-family: Arial, sans-serif; font-size: 14px; color: #333333; line-height: 1.6;'>接下来请点击<a href='$urll' style='color: #1e90ff; text-decoration: none;'>这里</a>来激活您的邮箱，链接1小时内有效 ⏳。</p>
<p style='font-family: Arial, sans-serif; font-size: 14px; color: #333333; line-height: 1.6;'>如果您无法点击，请直接访问：<a href='$urll' style='color: #1e90ff; text-decoration: none;'>$urll</a></p>
<br>
<p style='font-family: Arial, sans-serif; font-size: 14px; color: #333333; line-height: 1.6;'>我们强烈建议您在完成验证后删除这封验证邮件。忘掉这件事，未来是光明而美丽的 🌟，爱它吧 ❤️，向它突进 🚀，为它工作 💪，迎接它 👋，尽可能地使它成为现实吧 🌈。期待未来这封信与你再次相遇时，您已完成自己心中定下的目标 🎯！</p>
<p style='font-family: Arial, sans-serif; font-size: 14px; color: #333333; line-height: 1.6;'>为了确保在未来能收到这封信，请记得将".EMAIL_SET['email']."添加到邮箱白名单。</p>
<br>
<p style='font-family: Arial, sans-serif; font-size: 14px; color: #333333; line-height: 1.6;'>若您并没有在".TITLE."发送过邮件，请忽略这封邮件。如果您长时间被该邮件打扰，请通过邮件联系我们。</p>
<p style='font-family: Arial, sans-serif; font-size: 12px; color: #666666; text-align: center; margin-top: 20px;'>&copy; ".date('Y')." ".TITLE.". All rights reserved.</p>
";

try{
    $return = emailsend($email,TITLE."邮箱验证",$html);
    if($return["code"] == 200){
//    if(true){
        $conn->commit();
        echo 200;
        return;
    }
}catch (Exception $e){
    $conn->rollback();
    echo("错误代码:emailapi error,请联系网站管理员处理!");
}

?>