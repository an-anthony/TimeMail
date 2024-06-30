# 时光邮局 TimeMail

---

<a href="http://www.apache.org/licenses/LICENSE-2.0.html"> 
<img src="https://img.shields.io/github/license/an-anthony/TimeMail.svg" alt="License"></a>
<a href="https://github.com/an-anthony/TimeMail/stargazers"> 
<img src="https://img.shields.io/github/stars/an-anthony/TimeMail.svg" alt="GitHub stars"></a>
<a href="https://github.com/an-anthony/TimeMail/network/members"> 
<img src="https://img.shields.io/github/forks/an-anthony/TimeMail.svg" alt="GitHub forks"></a> 

## 简介
> 给未来写封信<br />
> 多年之后,愿你不负所期.<br />
> 时间没有现在,永恒没有未来,也没有过去<br />
> 未来的你,过的还好吗?<br />
> 给未来写封信,从过去获得惊喜,<br />
> 给未来的自己带来些鼓励的话,<br />
> 或是写下一些目标,看未来的自己是否实现

# 初衷
制作这个项目的初衷是为了让我们放下手边的一些事,或是给自己定下一个目标,或是仅仅只是一段对自己未来的憧憬。


在这个平台寄送出去,寄出的信是不可撤回的,也不可查找,希望你也忘掉这件事,直到你收到信的那一天,也给自己一个惊喜.在那一天回忆起写这封信的时候,带着更多的可能是一种怀念?或许这封邮件会激励你越走越远...
  

在看到原来的xsot项目后，打算下载下来，修正一下，重新让开源项目"焕发生机"。


注：该fork在原项目的基础上进行了修改

# 说明
1. 基于Apache 2.0开源协议开源,使用过程中涉及到的一切可能造成损失的因素,由运营者承担,与本人无关.

2. 目前 [mail.scale-lab.cn](https://mail.scale-lab.cn)为本项目的部署站点, 站点有可能会略快于本仓库代码(因为在这个环境上测试哈哈哈哈哈)

3. 我们打算开发一些很好玩的其它项目。如果感兴趣，来加个好友？（哪怕是为了加个用户交流群也行）

![加个好友](static/img/qrcode.png)

# 快速开始
1. 修改根目录下的`siteinfo.example.php`文件,将DATABASE常量依据注释中的提示指向数据库地址,并导入根目录下的`time.sql`文件.

2. 修改其他基本信息,注意网址必须区分https与http,否则可能导致邮件无法发送,在修改smtp信息的同时请注意填写正确,区分好授权码和密码.

3. 将常量`IF_SET`修改为`true`,用于标识已经修改config信息. 之后，去掉文件名中的`example`。

4. 至此,已经安装完毕,请注意如果任然无法发送邮件,可能是服务商屏蔽了25等常用smtp端口,请尝试与服务商取得联系得到支持,同时也注意服务器是否放通了该类端口,或者查看是否是WAF(Nginx防火墙)屏蔽了海外访问等常见问题.

5. 最后记通过crontab或其他方式添加一个计划任务,定时访问`api/send.php?key=你的key`，用于定时发信。**务必修改key**。


# 需要注意

如果搭建该平台，希望您能遵守约定，将所有信件按时寄出。哪怕不能，都要尽可能**保证用户隐私**。

