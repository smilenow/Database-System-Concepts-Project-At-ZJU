<?php
/**
 * Created by PhpStorm.
 * User: SmilENow
 * Date: 14-3-30
 * Time: 下午12:31
 */
    header("Content-Type: text/html;charset=utf-8");
    if (!isset($_SESSION)) session_start();

    include("main_workbench.php");

    $k = add_admini($_POST['id'],$_POST['pwd'],$_POST['username'],$_POST['tel']);
?>

<html>
<body  style="background-color:#75c6ff">
<title>添加管理员</title>

<p align="right">
    <?php echo "欢迎你，超级管理员"; ?>
</p>

<p align="center">
    <?php
    for($i=0; $i<135; $i++) print "_";
    ?>
</p>
<br/>
<br/>

<p align="center">
    <?php echo $k ?>
</p>

<form action="indexsudo.php" method="post">
    <p align="center">
        <input type="submit" value="返回">
    </p>
</form>

</body>
</html>