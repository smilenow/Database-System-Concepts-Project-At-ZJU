<?php
/**
 * Created by PhpStorm.
 * User: SmilENow
 * Date: 14-3-30
 * Time: 下午4:12
 */

    header("Content-Type: text/html;charset=utf-8");
    if (!isset($_SESSION)) session_start();

    include("main_workbench.php");
?>

<html>
<body style="background-color:#75c6ff">
<title>查看所有管理员信息</title>

    <h3 align = "center">
        <?php echo "欢迎你，超级管理员"; ?>
    </h3>

    <p align="center">
        <?php
        for($i=0; $i<135; $i++) print "_";
        ?>
    </p>
    <br/>

    <p align="center">
        <?php
            $connection = con_LMS();
            $sql = "select * from admin".";";
            $result = $connection->query($sql) or trigger_error($connection->error."[$sql]");
            while ($row = $result->fetch_array()) $rows[]=$row;
            if ((!isset($rows[0])) || ($rows[0] == NULL)){
                $result->free();
                $connection->close();
                echo "系统中暂时没有任何管理员信息";
                echo "<br/>";
            }else{?>
                <table border="1">
                    <tr>
                        <td>管理员账号</td>
                        <td>密码</td>
                        <td>用户名</td>
                        <td>联系方式</td>
                    </tr>
                <?php
                    foreach ($rows as $now){
                ?>
                    <tr>
                        <td><?php echo $now['id']; ?></td>
                        <td><?php echo $now['pwd']; ?></td>
                        <td><?php echo $now['username']; ?></td>
                        <td><?php echo $now['tel']; ?></td>
                    </tr>
                <?php
                }
                ?>
                </table>
            <?php
            }
        ?>
    </p>


    <form action="indexsudo.php" method="post">
        <p align="center">
            <input type="submit" value="返回">
        </p>
    </form>

</body>
</html>