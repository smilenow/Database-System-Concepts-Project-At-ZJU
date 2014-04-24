<?php
/**
 * Created by PhpStorm.
 * User: SmilENow
 * Date: 14-3-28
 * Time: 下午8:43
 */
    header("Content-Type: text/html;charset=utf-8");
    session_start();

    if (isset($_SESSION['login_info'])){
        if ($_SESSION['login_info'] != "") $val = $_SESSION['login_info'];
        else $val = "欢迎使用图书管理系统";
    }else{
        $_SESSION['login_info'] = "";
        $val = "欢迎使用图书管理系统";
    }
?>

<html>
<body  style="background-color:#75c6ff">
<title>欢迎使用图书管理系统</title>

    <form action="sudo.php" method="post">
        <p align="right">
            <input type="submit" value="超级管理员登陆">
        </p>
    </form>

    <p align="center">
        <?php
        for($i=0; $i<135; $i++) print "_";
        ?>
    </p>
    <br/>

    <form action = "check.php" method = "post">
        <h3 align = "center">
            <?php echo $val ?>
        </h3>

        <p align = "center">
            <table>
            <tr>
                <td>账 户:</td>
                <td><input type ="text" name="id"></td>
            </tr>
            <tr>
                <td>密 码:</td>
                <td><input type ="password" name="pwd"></td>
            </tr>
            <tr>
                <td><input type="submit"></td>
                <td><input type="reset"></td>
            </tr>
            </table>
        </p>

    </form>

</body>
</html>
