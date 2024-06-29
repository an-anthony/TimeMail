<!doctype html>
<html>

<head>
    <?php require_once './common/meta.php'; ?>
</head>

<?php
  require_once "./common/config.php";
  $code = $_GET['c'];
  $arr = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `check` WHERE `code`='$code';")); // TODO: sql注入防御
  @$uid = $arr['uid'];
  @$timefrom = $arr['time'];
  //获取输入请求时间,用于验证是否失效

  if(empty($timefrom))
  {
    $info = "该链接已失效!";
  }elseif((time()-  $timefrom) > 3600){
    mysqli_query($conn,"DELETE FROM `check` WHERE `uid`='$uid';");
    mysqli_query($conn,"DELETE FROM `checking` WHERE `uid`='$uid';");
    $info = "该链接已失效!";
  }else{
    $result = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `checking` WHERE `uid`='$uid'"));
    $topic = $result['topic'];
    $content = $result['content'];
    $email = $result['email'];
    $timenow = $result['from'];
    $time = $result['to'];
    $ip = $result['ip'];
    //获取基本信息
      
    mysqli_query($conn,"DELETE FROM `check` WHERE `uid`='$uid';");
    mysqli_query($conn,"DELETE FROM `checking` WHERE `uid`='$uid';");
    mysqli_query($conn,"INSERT INTO `waiting` VALUES('$uid','$topic','$content','$email','$timenow','$time','$ip')");
    
    $info = "恭喜你,验证成功!";
  }
?>

<body>
    <?php require_once ("./common/navbar.php"); ?>
    <div style="Height:40px"></div>
    <div class="mdui-container" style="max-width: 500px;">
        <div class="mdui-card">
            <div class="mdui-card-menu">
                <button onclick="window.location.href='/'" class="mdui-btn mdui-btn-icon mdui-text-color-grey"><i class="mdui-icon material-icons">home</i>
                </button>
            </div>
            <div class="mdui-card-primary">
                <div class="mdui-card-primary-title">邮件确认</div>
                <div class="mdui-card-primary-subtitle">Corfirm State</div>
            </div>
            <div class="mdui-card-content">
                <center>
                    <h2><?php echo $info ?></h2>
                </center>
                <br>
            </div>
        </div>
    </div>
</body>




    <?php require_once './common/footer.php'; ?>
</html>