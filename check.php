<?php
require_once "./common/config.php";

if(empty($_GET['c'])){
    header("Location: index.php", true, 301);
    return;
}
$code = mysqli_real_escape_string($conn,  $_GET['c']);
$arr = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `check` WHERE `code`='$code';"));
@$uid = $arr['uid'];
@$timefrom = $arr['time'];
//获取输入请求时间,用于验证是否失效
$conn->begin_transaction();

if(empty($timefrom))
{
    $info = "该链接已失效!";

}elseif((time()-  $timefrom) > 3600){
//    mysqli_query($conn,"DELETE FROM `check` WHERE `uid`='$uid';");
//    mysqli_query($conn,"DELETE FROM `checking` WHERE `uid`='$uid';");
    $info = "该链接已失效!";
}else{

    $result = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `checking` WHERE `uid`='$uid'"));
    $topic =$result['topic'];
    $content = $result['content'];
    $email = $result['email'];
    $timenow = $result['from'];
    $time = $result['to'];
    $ip = $result['ip'];
    $publish = $result['publish'];

    $stmt = $conn->prepare("INSERT INTO `waiting` (`uid`, `topic`, `content`, `email`, `from`, `to`, `ip`,`publish`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssi", $uid,$topic,$content,$email,$timenow,$time,$ip,$publish);
    if($stmt->execute()){
        mysqli_query($conn,"DELETE FROM `check` WHERE `uid`='$uid';");
        mysqli_query($conn,"DELETE FROM `checking` WHERE `uid`='$uid';");
        $info = "我们已收到您的确认信息，将按约定时间为您发送邮件。<br />谢谢您使用". TITLE ."📮";
    }else{
        $info = "我们的服务暂时出现了问题，请稍候重试。<br />您的链接有效期不变。您可以联系我们排查问题哦~";
    }

    
}
$conn->commit();
?>

<!doctype html>
<html>

<head>
    <?php require_once './common/view/meta.php'; ?>
</head>



<body class="mdui-drawer-body-left mdui-appbar-with-toolbar">
    <?php require_once("./common/view/navbar.php"); ?>
    <div style="Height:40px"></div>
    <div class="mdui-container" style="max-width: 500px;">
        <div class="mdui-card">
            <div class="mdui-card-menu">
                <button onclick="window.location.href='/'" class="mdui-btn mdui-btn-icon mdui-text-color-grey"><i class="mdui-icon material-icons">home</i>
                </button>
            </div>
            <div class="mdui-card-primary">
                <div class="mdui-card-primary-title">邮件确认</div>
<!--                <div class="mdui-card-primary-subtitle">📫</div>-->
            </div>
            <div class="mdui-card-content">
                <div style="text-align: center;">
                    <h3><?php echo $info ?></h3>
                </div>
                <br>
            </div>
        </div>
    </div>
</body>




    <?php require_once './common/view/footer.php'; ?>
</html>