<?php
/**
 * Created by PhpStorm.
 * User: SmilENow
 * Date: 14-3-29
 * Time: 上午12:32
 */
    header("Content-Type: text/html;charset=utf-8");
    if (!isset($_SESSION)) session_start();

    include("main_workbench.php");
    $val = FindAdmin($_SESSION['admin']);
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

    <form action="Select_Book.php" method="post">

        <p align = "center">
        <h3 align="center">图书查询</h3>
        <p/>
        <br/>

        <p align ="center">
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
                <td>起始年份:</td>
                <td><input type ="text" name="years"></td>
            </tr>
            <tr>
                <td>结束年份:</td>
                <td><input type ="text" name="yeart"></td>
            </tr>
            <tr>
                <td>作者:</td>
                <td><input type ="text" name="author"></td>
            </tr>
            <tr>
                <td>起始价格:</td>
                <td><input type ="text" name="prices"></td>
            </tr>
            <tr>
                <td>结束价格:</td>
                <td><input type ="text" name="pricet"></td>
            </tr>
            <tr>
                <td>模糊搜索:</td>
                <td><input type="radio" name="likename" value="likename"></td>
            </tr>
            <tr>
                <td>排序(默认是书名):</td>
                <td>
                    <input type = "radio" name="order" value="isdn">书号<br>
                    <input type = "radio" name="order" value="booktype">类别<br>
                    <input type = "radio" name="order" value="bookname">书名<br>
                    <input type = "radio" name="order" value="press">出版社<br>
                    <input type = "radio" name="order" value="year">年份<br>
                    <input type = "radio" name="order" value="author">作者<br>
                    <input type = "radio" name="order" value="price">价格<br>
                </td>
            </tr>
            <tr>
                <td>排序类型(默认是降序):</td>
                <td>
                    <input type="radio" name="INCDEC" value="inc">升序<br>
                    <input type="radio" name="INCDEC" value="dec">降序<br>
                </td>
            </tr>
            <tr>
                <td><input type="submit" value="查询"></td>
                <td><input type="reset"></td>
            </tr>
        </table>
        </p>

    </form>

    <form action="return_index.php" method="post">
        <p align="center">
            <input type="submit" value="返回">
        </p>
    </form>

</body>
</html>