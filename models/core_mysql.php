<?php

header('content-type:text/html;charset=utf-8');
$servername = "localhost"; //域名
$username = "root"; //账户名
$password = "www1234560."; //密码
$dbname = "cloudsign"; //数据库名

$mysqli = new mysqli($servername, $username, $password, $dbname);
if ($mysqli->connect_errno) {
die($mysqli->connect_error);
}
$mysqli->set_charset('utf8mb4');

session_start();