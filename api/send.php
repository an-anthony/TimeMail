<?php
require_once "../common/config.php";

if(empty($_GET["key"]) || $_GET["key"] !== EMAIL_SET['key']){
    header("HTTP/1.1 400 Bad Request");
    exit();
}

$succ = 0;
//计数
$error = 0;
while (true) {
    $time = time();
  $re = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `waiting` WHERE `to`<= $time"));
  //读取数据库信息
  if (!empty($re)) {
    $conn->begin_transaction();
    $html = "
<h2 style='color: #333333; font-family: Arial, sans-serif;'>📬 ".TITLE." 📬</h2>
<p style='font-family: Arial, sans-serif; font-size: 14px; color: #333333; line-height: 1.6;'>
    嗨！您收到一封来自 " . date("Y年m月d日", $re['from']) . " 的信件：
</p>
<div style='padding: 15px; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 5px; margin: 20px 0; font-family: Arial, sans-serif; font-size: 14px; color: #333333; line-height: 1.6;'>
    " . nl2br($re['content']) . "
</div>
";
    if($re['publish']==1){
        $html = $html ."
    <p style='font-family: Arial, sans-serif; font-size: 14px; color: #333333; line-height: 1.6;'>
        还有一件事：您在当时选择了公开这封信。我们可能会在删除您的敏感信息后，向大家分享您的故事。如果您改变了主意，记得联系我们。
    </p>
";
    }
    $html = $html ."
<p style='font-family: Arial, sans-serif; font-size: 14px; color: #333333; line-height: 1.6;'>
    我们也很好奇您的近状😘！如果您愿意让其他人知道这些日子里发生了什么，欢迎回复邮件至".EMAIL_SET["email"]."。
</p>
<p style='font-family: Arial, sans-serif; font-size: 14px; color: #333333; line-height: 1.6;'>
    感谢使用<a href='".URL."' style='color: #1e90ff; text-decoration: none;'>".TITLE."</a> 📮, 希望我们下次再见~
</p>
<p style='font-family: Arial, sans-serif; font-size: 12px; color: #666666; text-align: center; margin-top: 20px;'>&copy; ".date('Y')." ".TITLE.". All rights reserved.</p>
";

      $return = emailsend($re['email'],$re['topic'],$html);
    if ($return = 200) {
      $uid = $re['uid'];
      $topic = $re['topic'];
      $content = $re['content'];
      $email = $re['email'];
      $timenow = $re['from'];
      $time = $re['to'];
      $ip = $re['ip'];
        $publish = $re['publish'];
      $confirm_time = $re['confirm_time'];
        //删除原数据
        mysqli_query($conn,"DELETE FROM `waiting` WHERE `uid`='$uid';");
        //迁移数据
        $stmt = $conn->prepare("INSERT INTO `sent` (`uid`, `topic`, `content`, `email`, `from`, `to`, `ip`,`publish`, `confirm_time`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssis", $uid,$topic,$content,$email,$timenow,$time,$ip,$publish,$confirm_time);
        $stmt->execute();

      $conn->commit();
      $succ++;
    } else {
      $error++;
    }
  } else {
    break;
  }
}
if ($error + $succ !== 0) {
  echo "处理完毕 -> ".$succ."封邮件发送成功! | ".$error."封邮件发送失败\r\n";
}else{
  echo "无今日邮件!\r\n";
}
?>