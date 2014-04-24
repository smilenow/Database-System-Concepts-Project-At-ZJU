<?php
/**
 * Created by PhpStorm.
 * User: SmilENow
 * Date: 14-3-30
 * Time: 下午12:43
 */
    header("Content-Type: text/html;charset=utf-8");
    if (!isset($_SESSION)) session_start();

    include("main_workbench.php");

    $k = delete_admini($_POST['id']);
?>

<html>
<body  style="background-color:#75c6ff">
<title>删除管理员</title>

    <p align="right">
        <?php echo "删除管理员"; ?>
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