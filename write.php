<!doctype html>
<html>

<head>
    <?php require_once("./common/view/meta.php"); ?>
    <?php require_once ("./common/siteinfo.php"); ?>
</head>
<body class="mdui-drawer-body-left mdui-appbar-with-toolbar">
<?php require_once './common/view/navbar.php'; ?>
<div class="mdui-container doc-container">
    <div class="mdui-typo">
        <blockquote>
            <div class="mdui-typo-title-opacity" >注意事项:</div>
            <p>
                寄出的信是<span class="mdui-text-color-indigo">不可撤回的</span>，也<span class="mdui-text-color-indigo">不可查找</span>,希望你也忘掉这件事,直到你收到信的那一天。<br />
                同时在投递的那一刻我们将向你的邮箱发送一封确认邮件,只有点击确认邮件中的链接,您才能在未来收到邮件.<br />
                请记得将<?php echo(str_replace("@","#",EMAIL_SET["email"],))?>(#替换成@)加入邮箱白名单,以防收不到信<br />
                如果您正在使用QQ/微信客户端，建议您使用浏览器打开以确保最好的体验。<br />
                更多请访问菜单栏中的关于页面
            </p>
        </blockquote>
    </div>

    <br />
    <div class="mdui-typo">
        <h2>写信</h2>

        <div class="mdui-textfield">
            <h5>你希望在未来的哪一天收到信？</h5>
            <input id="time" time="time" class="mdui-textfield-input" type="date"/>
        </div>
        <div class="mdui-textfield">
            <h5>标题</h5>
            <input id="topic" time="topic" placeholder="一封来自<?php echo date("Y") . "年" . date("m") . "月" . date("d") . "日的信件" ?>" class="mdui-textfield-input" type="text" />
        </div>
        <div class="mdui-textfield">
            <h5>信件内容</h5>
            <textarea rows="10" cols="20" id="content" time="content" class="mdui-textfield-input" type="text" placeholder="你想写的内容"></textarea>
        </div>
        <div class="mdui-textfield">
            <h5>收信邮箱</h5>
            <input id="email" time="email" class="mdui-textfield-input" type="text" placeholder="收信邮箱" />
        </div>
        <div class="mdui-textfield">
            <h5>你希望在信件送达后公开内容吗？</h5>
            <label class="mdui-switch">
                <input id="publish" type="checkbox" value="publish"/>
                <i class="mdui-switch-icon"></i>
            </label>
        </div>
        <div class="mdui-textfield">
            <h5>验证码</h5>
            <img id="captchaImg" style="width: 120px" src="api/get_captcha.php" onclick="this.src='api/get_captcha.php?' +Math.random();" />
            <input id="captcha" time="text" class="mdui-textfield-input" type="text" placeholder="不区分大小写" />
        </div>
        <div class="mdui-textfield">
            <p>您的信息十分重要，继续即表明你同意我们的<a href="#">用户条款</a>和<a href="#">隐私条款</a>。</p>
            <button onClick="beforeSubmit();" id="Submit" class="mdui-btn mdui-btn-raised mdui-ripple mdui-text-center">保存并验证邮箱<i class="mdui-icon material-icons">near_me</i></button>
        </div>


    </div>
</div>



<!-- 加载 -->
<div id='loading' style="position: absolute;margin: auto;top: 0;left: 0;right: 0;bottom: 0;display: none;width: 50px;height: 50px" class="mdui-spinner mdui-spinner-colorful"></div>

<script>

    function beforeSubmit(){
        mdui.confirm("您确认要提交吗？<br />提交后的信件内容、时间都不可以再更改了哦（*゜ー゜*）", "是否确认", Submit);

    }
    function Submit() {
        var $ = mdui.JQ;

        $.showOverlay(); //遮罩
        $('#loading').show();

        $.ajax({
            method: 'POST',
            url: './submit.php',
            timeout: 10000,
            data: {
                time: $('#time').val(),
                content: $('#content').val(),
                email: $('#email').val(),
                topic: $('#topic').val(),
                public: $('#public').val(),
                captcha: $('#captcha').val(),
                publish: $("#publish").is(":checked")
            },
            success:function(data)
            {
                if (data == 200) {
                    mdui.dialog({
                        title: '投递成功📬',
                        content: '我们已经向您的邮箱发送了一封验证邮件,请在1小时内点击邮箱内的验证链接,这样在未来您才会收到信件哦!',
                        modal: true
                    });
                } else {
                    mdui.snackbar({
                        message: '发送失败<br/>原因:' + data,
                        position: 'right-top',
                    });
                }
            },
            complete:function(xhr,status){
                setTimeout(function () {$.hideOverlay();}, 100); //移除遮罩
                $('#loading').hide();
                $("#captchaImg")[0].click();
                $('#captcha').val("");
                if(status == 'timeout')
                {
                    mdui.snackbar({
                        message: '请求超时...',
                        position: 'right-top',
                    });
                }
            }
        });
    }
</script>
    <br />
    <br />
    <br />
    <br />
    <?php require_once "./common/view/footer.php"; ?>
</body>
</html>