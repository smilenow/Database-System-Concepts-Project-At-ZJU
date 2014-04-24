<?php
/**
 * Created by PhpStorm.
 * User: SmilENow
 * Date: 14-3-28
 * Time: 下午5:42
 */

$db_host="127.0.0.1";
$db_user="root";
$db_pwd="smilenow";

$connection = new mysqli();
$connection->connect($db_host,$db_user,$db_pwd);

if ($connection->connect_error){
    die('could not connect! ');
}

// set up the database;
if ($connection->query("create database LibraryManagementSystem")){
    echo "database LMS created!" . "<br/>";
}else{
    echo "database LMS failed to create!" . "<br/>";
}

$connection->close();

$now_db = new mysqli();
$now_db->connect($db_host,$db_user,$db_pwd,"LibraryManagementSystem");

$query = "create table admin(
    id varchar(10) not null,
    pwd varchar(20) not null,
    username varchar(30) not null,
    tel varchar(11) not null,
    primary key(id)
);";

$now_db->query($query);

$query = "create table usercard(
    uid varchar(10) not null,
    username varchar(20) not null,
    department varchar(20) not null,
    usertype varchar(10) not null,
    primary key(uid)
);";

$now_db->query($query);

$query = "create table book(
    isdn varchar(30) not null,
    booktype varchar(30) not null,
    bookname varchar(30) not null,
    press varchar(50) not null,
    year int not null,
    author varchar(20) not null,
    price numeric(6,2) not null,
    total int not null,
    stock int not null,
    primary key(isdn)
);";

$now_db->query($query);

$query = "create table record(
    bid int not null,
    uid varchar(10) not null,
    isdn varchar(30) not null,
    borrow_date date not null,
    return_date date not null,
    id varchar(10) not null,
    primary key(bid),
    foreign key(uid) references usercard(uid),
    foreign key(isdn) references book(isdn),
    foreign key(id) references admin(id)
);";

$now_db->query($query);

$now_db->close();

?>
