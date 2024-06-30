<?php require_once(__DIR__."/../"."siteinfo.php"); ?>

<footer>
<div class="mdui-divider"></div>
<div style="text-align: center; "  class="mdui-typo">
    <p>
        <?php
            if(defined("ICP_NUM") && ICP_NUM != ""){
                echo '<br /><small><a href="https://beian.miit.gov.cn/"  class="mdui-text-color-theme-secondary" target="_blank">'. ICP_NUM .'</a></small>';
            }
        ?>
    <p>
</div>

</footer>

