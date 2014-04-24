<?php
/**
 * Created by PhpStorm.
 * User: SmilENow
 * Date: 14-3-29
 * Time: 上午12:58
 */
    header("Content-Type: text/html;charset=utf-8");
    if (!isset($_SESSION)) session_start();

    include("main_workbench.php");
    $val = FindAdmin($_SESSION['admin']);
?>

<html>
<body  style="background-color:#75c6ff">
<title>借阅图书</title>

    <p align="right">
        <?php echo "您好，".$val ?>
    </p>

    <p align="center">
        <?php
        for($i=0; $i<135; $i++) print "_";
        ?>
    </p>
    <br/>

    <form action="Borrow_Book_ID.php" method="post">
        <p align="center">
            <tr>
                <td>输入借书证号:</td>
                <td><input type="text" name="uid"></td>
            </tr>
            <br/>
            <input type="submit" value="查询已借书籍">
        </p>
    </form>
    <br/>

    <form action="Borrow_Book_ISDN.php" method="post">
        <p align="center">
            <table>
                <tr>
                    <td>输入书号:</td>
                    <td><input type="text" name="isdn"></td>
                </tr>
                <tr>
                    <td>输入借书证号:</td>
                    <td><input type="text" name="uid"></td>
                </tr>
            </table>
            <br/>

            <input type="submit" value="查询能否借用书籍">
        </p>
    </form>
    <br/>

    <form action="return_index.php" method="post">
        <p align="center">
            <input type="submit" value="返回">
        </p>
    </form>

</body>
</html>