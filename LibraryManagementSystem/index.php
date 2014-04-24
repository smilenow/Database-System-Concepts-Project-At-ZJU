<?php
/**
 * Created by PhpStorm.
 * User: SmilENow
 * Date: 14-3-28
 * Time: 下午10:51
 */
    header("Content-Type: text/html;charset=utf-8");
    if (!isset($_SESSION)) session_start();

    include("main_workbench.php");
    $val = FindAdmin($_SESSION['admin']);
?>

<html>
<body  style="background-color:#75c6ff">
<title>操作主页</title>

    <h3 align = "center">
        <?php echo "您好，".$val ?>
    </h3>

    <p align="center">
        <?php
        for($i=0; $i<135; $i++) print "_";
        ?>
    </p>
    <br/>

    <p align="center">
        <a href="insertbook.php">图书入库</a><br/><br/>
        <a href="selectbook.php">图书查询</a><br/><br/>
        <a href="borrowbook.php">借书</a><br/><br/>
        <a href="returnbook.php">还书</a><br/><br/>
        <a href="manageusercard.php">借书证管理</a><br/><br/>
        <a href="login.php">返回登录</a>
    </p>

</body>
</html>