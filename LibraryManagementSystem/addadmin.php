<?php
/**
 * Created by PhpStorm.
 * User: SmilENow
 * Date: 14-3-30
 * Time: 下午12:26
 */
    header("Content-Type: text/html;charset=utf-8");
    if (!isset($_SESSION)) session_start();

    include("main_workbench.php");
?>


<html>
<body  style="background-color:#75c6ff">
<title>添加管理员</title>

<p align="center">
    <?php echo "添加管理员"; ?>
</p>

<p align="center">
    <?php
    for($i=0; $i<135; $i++) print "_";
    ?>
</p>
<br/>

<form action="ADD_admin.php" method="post">
    <p align="center">
    <table>
        <tr>
            <td>新账号:</td>
            <td><input type="text" name="id"></td>
        </tr>
        <tr>
            <td>密码:</td>
            <td><input type="text" name="pwd"></td>
        </tr>
        <tr>
            <td>用户名:</td>
            <td><input type="text" name="username"></td>
        </tr>
        <tr>
            <td>联系方式:</td>
            <td><input type="text" name="tel"></td>
        </tr>
    </table>
    <input type="submit" value="添加">
    </p>
</form>
<br/>
<br/>

<form action="indexsudo.php" method="post">
    <p align="center">
        <input type="submit" value="返回">
    </p>
</form>

</body>
</html>