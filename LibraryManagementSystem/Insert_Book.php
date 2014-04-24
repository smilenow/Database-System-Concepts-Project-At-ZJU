<?php
/**
 * Created by PhpStorm.
 * User: SmilENow
 * Date: 14-3-29
 * Time: 上午12:12
 */
    header("Content-Type: text/html;charset=utf-8");
    if (!isset($_SESSION)) session_start();

    include("main_workbench.php");
    $val = FindAdmin($_SESSION['admin']);

    $k = insertbook($_POST['isdn'],$_POST['booktype'],$_POST['bookname'],$_POST['press'],$_POST['year'],$_POST['author'],$_POST['price'],$_POST['total']);

?>

<html>
<body  style="background-color:#75c6ff">
<title>图书入库</title>

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
        <table border="1">
            <tr>
                <td>书号</td>
                <td>类别</td>
                <td>书名</td>
                <td>出版社</td>
                <td>年份</td>
                <td>作者</td>
                <td>价格</td>
                <td>数量</td>
            </tr>
            <tr>
                <td><?php echo $_POST['isdn'] ?></td>
                <td><?php echo $_POST['booktype'] ?></td>
                <td><?php echo $_POST['bookname'] ?></td>
                <td><?php echo $_POST['press'] ?></td>
                <td><?php echo $_POST['year'] ?></td>
                <td><?php echo $_POST['author'] ?></td>
                <td><?php echo $_POST['price'] ?></td>
                <td><?php echo $_POST['total'] ?></td>
            </tr>
        </table>

        <?php echo $k ?>
    </p>
    <br/>

    <form action="return_index.php" method="post">
        <p align="center">
            <input type="submit" value="返回">
        </p>
    </form>

</body>
</html>