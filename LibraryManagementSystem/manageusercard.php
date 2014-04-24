<?php
/**
 * Created by PhpStorm.
 * User: SmilENow
 * Date: 14-3-29
 * Time: 上午11:46
 */
    header("Content-Type: text/html;charset=utf-8");
    if (!isset($_SESSION)) session_start();

    include("main_workbench.php");
    $val = FindAdmin($_SESSION['admin']);
?>

<html>
<body  style="background-color:#75c6ff">
<title>借书证管理</title>

    <p align="right">
        <?php echo "您好，".$val ?>
    </p>

    <p align="center">
        <?php
        for($i=0; $i<135; $i++) print "_";
        ?>
    </p>
    <br/>

    <p align="center">
        <?php echo "添加图书证"?>
    </p>

    <form action="addusercard.php" method="post">
        <p align="center">
            <table>
                <tr>
                    <td>新卡号:</td>
                    <td><input type="text" name="uid"></td>
                </tr>
                <tr>
                    <td>用户名:</td>
                    <td><input type="text" name="username"></td>
                </tr>
                <tr>
                    <td>单位:</td>
                    <td><input type="text" name="department"></td>
                </tr>
                <tr>
                    <td>类别:</td>
                    <td><input type="text" name="usertype"></td>
                </tr>
            </table>
            <input type="submit" value="添加">
        </p>
    </form>
    <br/>
    <br/>

    <p align="center">
        <?php echo "删除图书证"?>
    </p>

    <form action="delusercard.php" method="post">
        <p align="center">
            <table>
                <tr>
                    <td>卡号:</td>
                    <td><input type="text" name="uid"></td>
                </tr>
            </table>
            <input type="submit" value="删除">
        </p>
    </form>
    <br/>
    <br/>

    <form action="showall_usercard.php" method="post">
        <p align="center">
            <table>
                <tr><td><input type="submit" value="查询所有借书证信息"></td></tr>
            </table>
        </p>
    </form>
    <br/>
    <br/>

    <form action="return_index.php" method="post">
        <p align="center">
            <input type="submit" value="返回">
        </p>
    </form>

</body>
</html>