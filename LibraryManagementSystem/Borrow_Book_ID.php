<?php
/**
 * Created by PhpStorm.
 * User: SmilENow
 * Date: 14-3-29
 * Time: 上午1:07
 */
    header("Content-Type: text/html;charset=utf-8");
    if (!isset($_SESSION)) session_start();

    include("main_workbench.php");
    $val = FindAdmin($_SESSION['admin']);

    $result = borrow_book_id($_POST['uid']);
    while ($row=$result->fetch_array()) $rows[] = $row;

    if ((!isset($rows[0])) || ($rows[0] == NULL)) $k = "无借书记录";
        else $k = "借书查询如下";
?>

<html>
<body  style="background-color:#75c6ff">
<title>借阅图书查询</title>

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
        <?php
            if ((isset($rows[0])) && ($rows[0] != NULL)){?>
                <table border="1">
                    <tr>
                        <td>借书号</td>
                        <td>借书证号</td>
                        <td>书号</td>
                        <td>书名</td>
                        <td>借出日期</td>
                        <td>归还日期</td>
                        <td>经手人</td>
                    </tr>
                <?php
                $connection = con_LMS();
                foreach ($rows as $now){
                    $sql2 = "select bookname from book where isdn='" . $now['isdn'] . "'";
                    $result2 = $connection->query($sql2) or trigger_error($connection->error."[$sql2]");
                    $sql3 = "select username from admin where id='" . $now['id'] . "'";
                    $result3 = $connection->query($sql3) or trigger_error($connection->error."[$sql3]");
                    $row3 = $result3->fetch_array();
                    $row2 = $result2->fetch_array();?>
                    <tr>
                        <td><?php echo $now['bid'] ?></td>
                        <td><?php echo $now['uid'] ?></td>
                        <td><?php echo $now['isdn'] ?></td>
                        <td><?php echo $row2['bookname'] ?></td>
                        <td><?php echo $now['borrow_date'] ?></td>
                        <td><?php echo $now['return_date'] ?></td>
                        <td><?php echo $row3['username'] ?></td>
                    </tr>
                <?php
                    $result2->free();
                    $result3->free();
                }?>
                </table>
            <?php
            $connection->close();
            }?>
    </p>

    <?php $result->free(); ?>

    <form action="return_index.php" method="post">
        <p align="center">
            <input type="submit" value="返回">
        </p>
    </form>

</body>
</html>

