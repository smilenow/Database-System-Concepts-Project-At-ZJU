<?php
/**
 * Created by PhpStorm.
 * User: SmilENow
 * Date: 14-3-29
 * Time: 上午11:35
 */
    header("Content-Type: text/html;charset=utf-8");
    if (!isset($_SESSION)) session_start();

    include("main_workbench.php");
    $val = FindAdmin($_SESSION['admin']);

    $result = return_book_isdn($_POST['isdn'],$_POST['uid']);

    $connection = con_LMS();
    $row = $result->fetch_array();
    if ((!isset($row)) || ($row == NULL)) {
        $k = "无该借书记录";
    }else{
        $k = "还书成功";
        $sql2 = "update book set stock=stock+1 where isdn='" . $_POST['isdn'] . "'";
        $connection->query($sql2);
        $sql4 = "select bid from record where uid='" . $_POST['uid'] . "' and isdn='" . $_POST['isdn'] . "'";
        $result4 = $connection->query($sql4) or trigger_error($connection->error."[$sql4]");
        while ($row = $result4->fetch_array()) $rows[]=$row;
        $row=$rows[0];
        $sql3 = "delete from record where bid='" . $row['bid'] . "'";
        $connection->query($sql3);
        $result4->free();
    }
    $result->free();
    $connection->close();
?>

<html>
<body  style="background-color:#75c6ff">
<title>归还图书</title>

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
        <?php echo $k ?>
        <br/>
    </p>
    <br/>

    <form action="return_index.php" method="post">
        <p align="center">
            <input type="submit" value="返回">
        </p>
    </form>

</body>
</html>
