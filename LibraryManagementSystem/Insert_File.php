<?php
/**
 * Created by PhpStorm.
 * User: SmilENow
 * Date: 14-3-29
 * Time: 下午8:52
 */
    header("Content-Type: text/html;charset=utf-8");
    if (!isset($_SESSION)) session_start();

    include("main_workbench.php");
    $val = FindAdmin($_SESSION['admin']);
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
        <?php echo "图书入库成功！"; ?>
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
            <?php
                $fp = fopen("input.txt","r");
                for ($i = 1; $i <= 8; $i++) $now[$i] = "";
                $i=1;

                while (!feof($fp)){
                    $nowf = fgetc($fp);
                    if ($nowf == "\n"){
                    ?>
                    <tr>
                        <td><?php echo $now[1] ?></td>
                        <td><?php echo $now[2] ?></td>
                        <td><?php echo $now[3] ?></td>
                        <td><?php echo $now[4] ?></td>
                        <td><?php echo $now[5] ?></td>
                        <td><?php echo $now[6] ?></td>
                        <td><?php echo $now[7] ?></td>
                        <td><?php echo $now[8] ?></td>
                    </tr>
                    <?php
                        insertbook($now[1],$now[2],$now[3],$now[4],$now[5],$now[6],$now[7],$now[8]);
                        for ($i = 1; $i <= 8; $i++) $now[$i] = "";
                        $i=1;
                    }else{
                        if ($nowf == ","){
                            fgetc($fp);
                            $i++;
                        }else $now[$i] = $now[$i] . $nowf;
                    }
                }
                fclose($fp);
            ?>
        </table>
    </p>
    <br/>

    <form action="return_index.php" method="post">
        <p align="center">
            <input type="submit" value="返回">
        </p>
    </form>

</body>
</html>