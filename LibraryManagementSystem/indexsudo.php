<?php
/**
 * Created by PhpStorm.
 * User: SmilENow
 * Date: 14-3-30
 * Time: 下午12:24
 */
    header("Content-Type: text/html;charset=utf-8");
    if (!isset($_SESSION)) session_start();

    include("main_workbench.php");

?>


<html>
<body  style="background-color:#75c6ff">
<title>超级管理员权限</title>

<h3 align = "center">
    <?php echo "欢迎你，超级管理员"; ?>
</h3>

<p align="center">
    <?php
    for($i=0; $i<135; $i++) print "_";
    ?>
</p>
<br/>

<p align="center">
    <a href="addadmin.php">添加管理员</a><br/><br/>
    <a href="deladmin.php">删除管理员</a><br/><br/>
    <a href="showall_admin.php">查看所有管理员信息</a><br/><br/>
    <a href="login.php">返回登录</a>
</p>

</body>
</html>