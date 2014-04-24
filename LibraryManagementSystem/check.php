<?php
/**
 * Created by PhpStorm.
 * User: SmilENow
 * Date: 14-3-28
 * Time: 下午10:43
 */
    header("Content-Type: text/html;charset=utf-8");
    if (!isset($_SESSION)) session_start();

    include("main_workbench.php");

    $tmp = CheckAdmin($_POST['id'],$_POST['pwd']);
    if ($tmp == "管理员登陆成功！"){
        $_SESSION['admin'] = $_POST['id'];
        header("location:index.php");
    }else{
        header("location:login.php");
    }
?>