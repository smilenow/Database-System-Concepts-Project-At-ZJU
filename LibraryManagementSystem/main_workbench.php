<?php
header("Content-Type: text/html;charset=utf-8");
/**
 * Created by PhpStorm.
 * User: SmilENow
 * Date: 14-3-28
 * Time: 下午5:44
 */

//连接数据库
function con_LMS(){
    $db_host="127.0.0.1";
    $db_user="root";
    $db_pwd="smilenow";

    $connection = new mysqli();
    $connection->connect($db_host,$db_user,$db_pwd);

    if ($connection->connect_error) return "-1";
    $connection->close();

    $now_db=new mysqli();
    $now_db->connect($db_host,$db_user,$db_pwd,"LibraryManagementSystem");

    return $now_db;
}

//检查当前管理员是否合法
function CheckAdmin($id,$pwd){
    $connection = con_LMS();
    if ($connection == "-1"){
        $tmp = "连接数据库失败!";
        return $tmp;
    }

    $sql = "select * from admin where id='" . $id . "' and pwd='" . $pwd . "'";
    $result = $connection->query($sql) or trigger_error($connection->error."[$sql]");
    $row = $result->fetch_array();
    if ((!isset($row)) || ($row == NULL)){
        $tmp = "用户名或密码不正确，请重新输入";
        $_SESSION['login_info'] = $tmp;
        $result->free();
        $connection->close();
        return $tmp;
    }
    $result->free();
    $connection->close();
    $tmp = "管理员登陆成功！";
    $_SESSION['login_info'] = "欢迎使用图书管理系统";
    return $tmp;
}

//查询管理员名字
function FindAdmin($id){
    $connection = con_LMS();
    if ($connection == "-1"){
        $tmp = "连接数据库失败!";
        return $tmp;
    }

    $sql = "select username from admin where id='" . $id . "'";
    $result = $connection->query($sql) or trigger_error($connection->error."[$sql]");
    $row = $result->fetch_array();
    $tmp = $row['username'];
    $result->free();
    $connection->close();
    return $tmp;
}

//图书查询
function selectbook($isdn,$booktype,$bookname,$press,$years,$yeart,$author,$prices,$pricet,$order,$INCDEC,$likename){
    $connection = con_LMS();
    if ($connection == "-1"){
        $tmp = "连接数据库失败!";
        return $tmp;
    }
    $sqlbook = "";
    $sqlbookmark = 0;

    if (isset($isdn) && $isdn != ""){
        $sqlbook = "select * from book where isdn='" . $isdn . "' ";
        $sqlbookmark = 1;
    }
    if (isset($booktype) && $booktype != ""){
        if ($sqlbookmark == 0) $sqlbook = "select * from book where booktype='" . $booktype . "' ";
            else $sqlbook = $sqlbook . "and booktype='" . $booktype . "' ";
        $sqlbookmark = 1;
    }
    if (isset($bookname) && $bookname != ""){
        if ($likename == "no"){
            if ($sqlbookmark == 0) $sqlbook = "select * from book where bookname='" . $bookname . "' ";
                else $sqlbook = $sqlbook . "and bookname='" . $bookname . "' ";
        }else{
            if ($sqlbookmark == 0) $sqlbook = "select * from book where bookname like '%". $bookname . "%' ";
                else $sqlbook = $sqlbook . "and bookname like '%" . $bookname . "%' ";
        }
        $sqlbookmark = 1;
    }
    if (isset($press) && $press != ""){
        if ($sqlbookmark == 0) $sqlbook = "select * from book where press='" . $press . "' ";
            else $sqlbook = $sqlbook . "and press='" . $press . "' ";
        $sqlbookmark = 1;
    }
    if (isset($years) && $years != ""){
        if ($sqlbookmark == 0) $sqlbook = "select * from book where year between " . $years . " and " . $yeart . " ";
            else $sqlbook = $sqlbook . "and year between " . $years . " and " . $yeart . " ";
        $sqlbookmark = 1;
    }
    if (isset($author) && $author != ""){
        if ($sqlbookmark == 0) $sqlbook = "select * from book where author='" . $author . "' ";
            else $sqlbook = $sqlbook . "and author='" . $author . "' ";
        $sqlbookmark = 1;
    }
    if (isset($prices) && $prices != ""){
        if ($sqlbookmark == 0) $sqlbook = "select * from book where price between " . $prices . " and " . $pricet . " ";
            else $sqlbook = $sqlbook . "and price between " . $prices . " and " . $pricet . " ";
        $sqlbookmark = 1;
    }
    if (isset($order) && $order != "") $sqlbook = $sqlbook . "order by " . $order . " ";
        else $sqlbook = $sqlbook . "order by bookname ";
    if (isset($INCDEC) && $INCDEC == "inc") $sqlbook = $sqlbook . "asc ";
        else $sqlbook = $sqlbook . "desc ";
    $sqlbook = $sqlbook . "limit 0,50";
    $result = $connection->query($sqlbook) or trigger_error($connection->error."[$sqlbook]");
    return $result;
}

//单本入库
function insertbook($isdn,$booktype,$bookname,$press,$year,$author,$price,$total){
    $connection = con_LMS();
    if ($connection == "-1"){
        $tmp = "连接数据库失败!";
        return $tmp;
    }

    $sql = "select * from book where isdn='" . $isdn . "' ";
    $result = $connection->query($sql) or trigger_error($connection->error."[$sql]");
    $row = $result->fetch_array();
    if ((!isset($row)) || ($row == NULL)){
        $sql2 = "insert into book values('" . $isdn . "','" . $booktype . "','" . $bookname . "','" . $press . "'," . $year . ",'" . $author . "'," . $price . "," . $total . "," . $total . ");";
        $connection->query($sql2);
    }else{
        $sql2 = "update book set total=total+" . $total . " where isdn='" . $isdn . "'";
        $connection->query($sql2);
        $sql3 = "update book set stock=stock+" . $total . " where isdn='" . $isdn . "'";
        $connection->query($sql3);
    }
    $result->free();
    $connection->close();
    $tmp = "图书入库成功！";
    return $tmp;
}

//借书1
function borrow_book_id($uid){
    $connection = con_LMS();
    if ($connection == "-1"){
        $tmp = "连接数据库失败!";
        return $tmp;
    }

    $sql = "select * from record where uid='" . $uid . "'";
    $result = $connection->query($sql) or trigger_error($connection->error."[$sql]");
    return $result;
}

//借书2 注意借相同的书是更新而不是插入！要添加
function borrow_book_isdn($isdn,$uid,$id){
    $connection = con_LMS();
    if ($connection == "-1"){
        $tmp = "连接数据库失败!";
        return $tmp;
    }

    $sql = "select stock from book where isdn='". $isdn . "'";
    $result = $connection->query($sql) or trigger_error($connection->error."[$sql]");
    return $result;
}

//还书1 == 借书1
function return_book_id($uid){
    $connection = con_LMS();
    if ($connection == "-1"){
        $tmp = "连接数据库失败!";
        return $tmp;
    }

    $sql = "select * from record where uid='" . $uid . "'";
    $result = $connection->query($sql) or trigger_error($connection->error."[$sql]");
    return $result;
}

//还书2
function return_book_isdn($isdn,$uid){
    $connection = con_LMS();
    if ($connection == "-1"){
        $tmp = "连接数据库失败!";
        return $tmp;
    }

    $sql = "select * from record where uid='" . $uid . "' and isdn='" . $isdn . "'";
    $result = $connection->query($sql) or trigger_error($connection->error."[$sql]");
    return $result;
}

//借书证管理 增加
function add_usercard($uid,$username,$department,$usertype){
    $connection = con_LMS();
    if ($connection == "-1"){
        $tmp = "连接数据库失败!";
        return $tmp;
    }
    $sql = "select * from usercard where uid='" . $uid . "';";
    $result = $connection->query($sql) or trigger_error($connection->error."[$sql]");
    $row = $result->fetch_array();
    if ((isset($row)) && ($row != NULL)){
        $result->free();
        $connection->close();
        return "已存在借书证号相同的借书证，不能添加！";
    }
    $result->free();
    $sql2 = "insert into usercard values('" . $uid . "','" . $username . "','" . $department . "','" . $usertype . "');";
    $connection->query($sql2);
    $connection->close();
    return "成功添加借书证";
}

//借书证管理 删除
function delete_usercard($uid){
    $connection = con_LMS();
    if ($connection == "-1"){
        $tmp = "连接数据库失败!";
        return $tmp;
    }
    $sql = "select * from usercard where uid='" . $uid . "';";
    $result = $connection->query($sql) or trigger_error($connection->error."[$sql]");
    $row = $result->fetch_array();
    if ((!isset($row)) || ($row == NULL)){
        $result->free();
        $connection->close();
        return "查无此借书证，不能删除！";
    }
    $sql3 = "select * from record where uid='" . $uid . "';";
    $res = $connection->query($sql3);
    $row = $res->fetch_array();
    if ((isset($row)) && ($row != NULL)){
        $res->free();
        $result->free();
        $connection->close();
        return "该借书证已经借书，不能删除！";
    }
    $sql2 = "delete from usercard where uid='" . $uid . "';";
    $connection->query($sql2);
    $result->free();
    $connection->close();
    return "成功删除借书证";
}

//管理员管理 增加
function add_admini($id,$pwd,$username,$tel){
    $connection = con_LMS();
    if ($connection == "-1"){
        $tmp = "连接数据库失败!";
        return $tmp;
    }
    $sql = "select * from admin where id='" . $id . "';";
    $result = $connection->query($sql) or trigger_error($connection->error."[$sql]");
    $row = $result->fetch_array();
    if ((isset($row)) && ($row != NULL)){
        $result->free();
        $connection->close();
        return "已存在账号相同的管理员账号，不能添加！";
    }
    $result->free();
    $sql2 = "insert into admin values('" . $id . "','" . $pwd . "','" . $username . "','" . $tel . "');";
    $connection->query($sql2);
    $connection->close();
    return "成功添加管理员";
}

//管理员管理 删除
function delete_admini($id){
    $connection = con_LMS();
    if ($connection == "-1"){
        $tmp = "连接数据库失败!";
        return $tmp;
    }
    $sql = "select * from admin where id='" . $id . "';";
    $result = $connection->query($sql) or trigger_error($connection->error."[$sql]");
    $row = $result->fetch_array();
    if ((!isset($row)) || ($row == NULL)){
        $result->free();
        $connection->close();
        return "查无此管理员，不能删除！";
    }
    $sql3 = "select * from record where id='" . $id . "';";
    $result3 = $connection->query($sql3);
    while ($row = $result3->fetch_array()) $rows[]=$row;
    if ((isset($rows[0])) && ($rows[0] != NULL)){
        $result->free();
        $result3->free();
        $connection->close();
        return "该管理员已经有过外借书籍的操作，不能删除！";
    }
    $sql2 = "delete from admin where id='" . $id . "';";
    $connection->query($sql2);
    $result->free();
    $connection->close();
    return "成功删除该管理员";
}

?>