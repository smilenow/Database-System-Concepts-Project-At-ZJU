<?php
/**
 * Created by PhpStorm.
 * User: SmilENow
 * Date: 14-3-28
 * Time: 下午11:59
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

    <form action="Insert_Book.php" method="post">

        <p align = "center">
        <table border="1">
            <tr>
                <td>书号:</td>
                <td><input type ="text" name="isdn"></td>
            </tr>
            <tr>
                <td>类别:</td>
                <td><input type ="text" name="booktype"></td>
            </tr>
            <tr>
                <td>书名:</td>
                <td><input type ="text" name="bookname"></td>
            </tr>
            <tr>
                <td>出版社:</td>
                <td><input type ="text" name="press"></td>
            </tr>
            <tr>
                <td>年份:</td>
                <td><input type ="text" name="year"></td>
            </tr>
            <tr>
                <td>作者:</td>
                <td><input type ="text" name="author"></td>
            </tr>
            <tr>
                <td>价格:</td>
                <td><input type ="text" name="price"></td>
            </tr>
            <tr>
                <td>数量:</td>
                <td><input type ="text" name="total"></td>
            </tr>
            <tr>
                <td><input type="submit" value="单本入库"></td>
                <td><input type="reset"></td>
            </tr>
        </table>
        </p>

    </form>

    <br/>
    <br/>

    <form action="Insert_File.php" method="pos">
        <p align="center">
            <table>
                <tr><td>选择一个文件:<input type="file"></td></tr>
                <tr><td><input type="submit" value="批量入库"></td></tr>
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