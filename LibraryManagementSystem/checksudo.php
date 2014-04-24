<?php
/**
 * Created by PhpStorm.
 * User: SmilENow
 * Date: 14-3-30
 * Time: 下午12:22
 */
    header("Content-Type: text/html;charset=utf-8");
    if (!isset($_SESSION)) session_start();

    include("main_workbench.php");

    if ($_POST['id'] == "root" && $_POST['pwd'] == "smilenow"){
        header("location:indexsudo.php");
    }else{
        header("location:login.php");
    }
?>