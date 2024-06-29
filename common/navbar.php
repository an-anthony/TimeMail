<?php require_once("siteinfo.php"); ?>

<div class="">

    <header class="mdui-appbar mdui-appbar-fixed">
        <div class="mdui-toolbar mdui-color-theme">
          <span class="mdui-btn mdui-btn-icon mdui-ripple" mdui-drawer="{target: '#main-drawer'}">
            <i class="mdui-icon material-icons">menu</i>
          </span>
            <a href="" class="mdui-typo-title"><?php echo TITLE; ?></a>
    </header>
    <div class="mdui-drawer" id="main-drawer">
        <div class="mdui-list" mdui-collapse="{accordion: true}" style="margin-bottom: 68px;">
            <div class="mdui-list">
                <a href="/" class="mdui-list-item">
                    <i class="mdui-list-item-icon mdui-icon material-icons">filter_none</i>
                    &emsp;主页
                </a>
                <a href="write.php" class="mdui-list-item">
                    <i class="mdui-list-item-icon mdui-icon material-icons">mail_outline</i>
                    &emsp;写信
                </a>
                <a href="status.php" class="mdui-list-item">
                    <i class="mdui-list-item-icon mdui-icon material-icons">settings</i>
                    &emsp;状态
                </a>
                <a href="about.php" class="mdui-list-item">
                    <i class="mdui-list-item-icon mdui-icon material-icons">info_outline</i>
                    &emsp;关于
                </a>
            </div>
            <div class="mdui-collapse-item ">
                <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                    <i class="mdui-list-item-icon mdui-icon material-icons">&#xe80d;</i>
                    &emsp;其它
                    <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
                </div>
                <div class="mdui-collapse-item-body mdui-list">
                    <a href="#" class="mdui-list-item mdui-text-color-theme-secondary">一个链接</a>
                </div>
            </div>
        </div>
    </div>
    <br />
</div>