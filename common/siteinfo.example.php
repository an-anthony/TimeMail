<?php
    define('DATABASE',array("localhost","USER","PASS","DB"));
    //数据库配置  服务器/数据库用户名/数据库密码/数据库名称

    define("URL","http://example.com/");
    //网址 记住必须以/结尾

    define("TITLE","栖望时光邮局");
    //网站名称

    define("DEBUG", 0); // 0表示禁止PHP输出错误信息，使用E_ALL查看报错
    error_reporting(DEBUG);

    define('EMAIL_SET',array(
        'key' => 'rand', //随机值
        'smtp' => 'smtp.exmail.qq.com',   //SMTP 用户名  即邮箱的用户名
        'email' => 'service@example.com', //邮箱账户
        'passwd' => 'PASSWD', //SMTP 密码  部分邮箱是授权码(例如163邮箱)
        'Secure' => 'ssl',
        'setFrom' => 'service@example.com', //发件人
        'port' => '465', //服务器端口 25 或者465 具体要看邮箱服务器支持
        'name' => TITLE,  //发信名称
    ));
    //邮箱配置

    define("ICP_NUM", ""); // ICP备案号

    define('IF_SET',true);
    //用于判断是否手动修改配置，请再修改过后将此处的false改为true 如 替换为define('IF_SET',true);