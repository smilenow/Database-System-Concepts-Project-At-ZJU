<?php
/**
 * Created by PhpStorm.
 * User: SmilENow
 * Date: 14-3-30
 * Time: 下午3:32
 */

    header("Content-Type: text/html;charset=utf-8");
    if (!isset($_SESSION)) session_start();

    include("main_workbench.php");
    $val = FindAdmin($_SESSION['admin']);
?>

<html>
<body  style="background-color:#75c6ff">
<title>查询所有借书证</title>

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
        $connection = con_LMS();
        $sql = "select * from usercard".";";
        $result = $connection->query($sql) or trigger_error($connection->error."[$sql]");
        while ($row = $result->fetch_array()) $rows[]=$row;
        if ((!isset($rows[0])) || ($rows[0] == NULL)){
            $result->free();
            $connection->close();
            echo "系统中暂时没有任何借书证信息";
            echo "<br/>";
        }else{?>
            <table border="1">
                <tr>
                    <td>借书证号</td>
                    <td>用户名</td>
                    <td>单位</td>
                    <td>类别</td>
                </tr>
        <?php
            foreach ($rows as $now){
        ?>
                <tr>
                    <td><?php echo $now['uid']; ?></td>
                    <td><?php echo $now['username']; ?></td>
                    <td><?php echo $now['department']; ?></td>
                    <td><?php echo $now['usertype']; ?></td>
                </tr>
        <?php
            }
        ?>
            </table>
        <?php
        }
    ?>
    </p>

    <form action="return_index.php" method="post">
        <p align="center">
            <input type="submit" value="返回">
        </p>
    </form>

</body>
</html>