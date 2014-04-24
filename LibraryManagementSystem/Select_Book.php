<?php
/**
 * Created by PhpStorm.
 * User: SmilENow
 * Date: 14-3-29
 * Time: 上午12:38
 */
    header("Content-Type: text/html;charset=utf-8");
    if (!isset($_SESSION)) session_start();

    include("main_workbench.php");
    $val = FindAdmin($_SESSION['admin']);

    /*echo "<html><head><title>Count Casino</title></head><body>";
    echo "<p>";
    echo "In progress...please wait<br />";
    ob_flush();*/
    if ((!isset($_POST['likename'])) || ($_POST['likename'] == NULL)) $_POST['likename']="no";
    if ((!isset($_POST['order'])) || ($_POST['order'] == NULL)) $_POST['order']="bookname";
    if ((!isset($_POST['INCDEC']))|| ($_POST['INCDEC']== NULL)) $_POST['INCDEC']="dec";
    $result = selectbook($_POST['isdn'],$_POST['booktype'],$_POST['bookname'],$_POST['press'],$_POST['years'],$_POST['yeart'],$_POST['author'],$_POST['prices'],$_POST['pricet'],$_POST['order'],$_POST['INCDEC'],$_POST['likename']);

    /*echo "<html><head><title>Count Casino</title></head><body>";
    echo "<p>";
    echo "In progress...please wait<br />";
    ob_flush();*/

    while ($row=$result->fetch_array()) $rows[] = $row;

    if ((!isset($rows[0])) || ($rows[0] == NULL)) $k = "查无此书";
        else $k = "查询结果如下";
?>

<html>
<body  style="background-color:#75c6ff">
<title>图书查询</title>

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
            echo $k;
            echo "<br/>";
        ?>
        <?php
            if ((isset($rows[0])) && ($rows[0] != NULL)){
        ?>
                <table border="1">
                    <tr>
                        <td>书号</td>
                        <td>类别</td>
                        <td>书名</td>
                        <td>出版社</td>
                        <td>年份</td>
                        <td>作者</td>
                        <td>价格</td>
                        <td>总藏书量</td>
                        <td>库存</td>
                    </tr>
                    <?php
                    foreach ($rows as $now){
                    ?>
                        <tr>
                            <td><?php echo $now['isdn']; ?></td>
                            <td><?php echo $now['booktype']; ?></td>
                            <td><?php echo $now['bookname']; ?></td>
                            <td><?php echo $now['press']; ?></td>
                            <td><?php echo $now['year']; ?></td>
                            <td><?php echo $now['author']; ?></td>
                            <td><?php echo $now['price']; ?></td>
                            <td><?php echo $now['total']; ?></td>
                            <td><?php echo $now['stock']; ?></td>
                        <tr/>
                    <?php } ?>
                </table>
            <?php } ?>
    </p>

    <p align="center">
    <?php
        $result->free();
        echo "<br/>";
        echo "注意：查询返回最多前五十条符合条件的图书信息";
    ?>
    </p>

    <form action="return_index.php" method="post">
        <p align="center">
            <input type="submit" value="返回">
        </p>
    </form>

</body>
</html>