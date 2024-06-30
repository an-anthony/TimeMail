<!doctype html>
<html>
    <head>
        <?php require_once("./common/view/meta.php"); ?>
        <?php require_once ("./common/siteinfo.php"); ?>
    </head>

<body class="mdui-drawer-body-left mdui-appbar-with-toolbar">
    <?php require_once './common/view/navbar.php'; ?>
    <div class="mdui-container">
        <div class="mdui-typo">
            <h2 class="doc-chapter-title doc-chapter-title-first">关于</h2>
            1. 寄出的信是<span class="mdui-text-color-indigo">不可撤回的</span>，也<span class="mdui-text-color-indigo">不可查找</span>,希望你也忘掉这件事,直到你收到信的那一天。<br />
            2. 同时在投递的那一刻我们将向你的邮箱发送一封确认邮件,只有点击确认邮件中的链接,您才能在未来收到邮件.<br />
            3. 请记得将<?php echo(str_replace("@","#",EMAIL_SET["email"],))?>(#替换成@)加入邮箱白名单,以防收不到信<br />
            4. 如果您正在使用QQ/微信客户端，建议您使用浏览器打开以确保最好的体验。<br />
            5. 更多请访问菜单栏中的关于页面<br />
            6.发送邮件请遵守当地法律法规!<br />
        </div>
        <div class="mdui-typo">
            <h2 class="doc-chapter-title doc-chapter-title-first">开放源代码许可</h2>
            &emsp;<ul>
                <p>系统建设无法离开各开源组件支持，谨以崇高敬意对以下项目表示感谢(排名不分先后)</p>
                <li>TimeMail by soxft(https://github.com/soxft/TimeMail) -- Apache 2.0</li>
                <li>mdui by zdhxiong(https://github.com/zdhxiong/mdui) -- MIT</li>
                <li>本程序源代码已公开(https://github.com/an-anthony/TimeMail), 请以Apache 2.0协议自由地使用</li>

            </ul>


        </div>

    </div>
    <br />
    <br />
    <?php  require_once "./common/view/footer.php"; ?>
</body>



</html>

