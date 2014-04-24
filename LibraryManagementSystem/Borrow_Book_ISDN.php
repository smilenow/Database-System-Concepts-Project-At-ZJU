<?php
/**
 * Created by PhpStorm.
 * User: SmilENow
 * Date: 14-3-29
 * Time: 上午1:41
 */
    header("Content-Type: text/html;charset=utf-8");
    if (!isset($_SESSION)) session_start();

    include("main_workbench.php");
    $val = FindAdmin($_SESSION['admin']);

    $result = borrow_book_isdn($_POST['isdn'],$_POST['uid'],$_SESSION['admin']);
    $row = $result->fetch_array();
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

    <p align="center">
    <?php
    if ((!isset($row)) || ($row == NULL)){
        echo "查无此书"."<br/>";
    }elseif ($row['stock'] == 0){ ?>
        <table>
            <tr>
                <td><?php echo "无库存"; ?></td>
            </tr>
            <tr>
                <td><?php echo "最近归还日期:"; ?></td>
                <?php
                    $connection = con_LMS();
                    $sql2 = "select return_date from record where isdn='" . $_POST['isdn'] . "' order by return_date limit 0,1;";
                    $result2 = $connection->query($sql2) or trigger_error($connection->error."[$sql2]");
                    $row2 = $result2->fetch_array();
                ?>
                <td><?php echo $row2['return_date']; ?></td>
            </tr>
        </table>
        <?php
        $result2->free();
        $connection->close();
    }else{
        echo "借书成功" . "<br/>";
        $connection = con_LMS();
        $sql2 = "update book set stock=stock-1 where isdn='" . $_POST['isdn'] . "'";
        $connection->query($sql2);
        if (!isset($_SESSION['record'])) $_SESSION['record']=1;
            else $_SESSION['record']=$_SESSION['record']+1;
        date_default_timezone_set('PRC');
        $borrow_date=date('Y-m-d');
        $rd=mktime(0,0,0,date('m')+1,date('d'),date('Y'));
        $return_date=date('Y-m-d',$rd);
        $sql3 = "insert into record values(". $_SESSION['record'] . ",'" . $_POST['uid'] . "','" . $_POST['isdn'] . "','" . $borrow_date . "','" . $return_date . "','" .$_SESSION['admin'] . "');";
        $connection->query($sql3);

        $connection->close();
    }
    $result->free();
    ?>
    </p>

    <form action="return_index.php" method="post">
        <p align="center">
            <input type="submit" value="返回">
        </p>
    </form>

</body>
</html>
