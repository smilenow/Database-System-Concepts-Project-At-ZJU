<?php
/**
 * Created by PhpStorm.
 * User: SmilENow
 * Date: 14-3-30
 * Time: 下午12:17
 */
    header("Content-Type: text/html;charset=utf-8");
    session_start();
?>


<html>
<body  style="background-color:#75c6ff">
<title>超级管理员登陆</title>

    <form action = "checksudo.php" method = "post">
        <h3 align = "center">
            <?php echo "超级管理员登陆"; ?>
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