<?php
    require_once ("./common/config.php");
    class Row {
        public function __construct($conn) {
            $this->sql = $conn;
        }

        public function getRow($tablename) {
            $this->commed = mysqli_fetch_assoc(mysqli_query($this->sql,"select * from `TABLES` where `TABLE_NAME`='$tablename'"));
            $this->num = $this->commed['TABLE_ROWS'];
            //所有数据
            echo $this->num;
        }
    }

    class status {
        var $conn;
        var $seconds;

        function __construct($conn) {
            $this->sql = $conn;
        }

        function getRuntime() {
            $this->Starttime = strtotime("2024-06-29");  //开始时间
            $this->Nowtime = strtotime(date("Y-m-d"));
            $this->diff = $this->Nowtime - $this->Starttime;
            $this->Runtime = abs(round($this->diff / 86400));
            echo $this->Runtime;
        }
    }
    // 服务是否在运行 | 已发送  | 未发送 | 发送时间段 | 累计运行时间段

    $status = new status($conn);
    $row = new Row($conns);
?>


<!doctype html>
<html>
<head>
    <?php require_once("./common/view/meta.php"); ?>
</head>
<body class="mdui-drawer-body-left mdui-appbar-with-toolbar">
    <?php require_once("./common/view/navbar.php"); ?>
    <div class="mdui-toolbar mdui-color-theme">
        <div class="mdui-typo-title">发送计划状态</div>
        <div class="mdui-typo-title-opacity"><small>实时数据可能会有一定延迟</small></div>
    </div>
    <br />
    <div class="mdui-container doc-container" style='max-width:85%'>
        <div class="mdui-typo">
            <div class="mdui-table-fluid">
                <table class="mdui-table">
                    <tbody>
                    <tr>
                        <td>运行天数</td>
                        <td><?php $status->getRuntime();?>天</td>
                    </tr>
                    <tr>
                        <td>已发送</td>
                        <td><?php $row->getRow("sent");?>封</td>
                    </tr>
                    <tr>
                        <td>待发送</td>
                        <td><?php $row->getRow("waiting");?>封</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <?php require_once "./common/view/footer.php"; ?>

</body>
</html>

