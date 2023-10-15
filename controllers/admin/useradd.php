<?php
include_once "../../models/core_mysql.php";

header('content-type:text/html;charset=utf-8');

$username = $_GET["username"];
$snumber = $_GET["snumber"];

useradd($mysqli , $username , $snumber);
//新增
function useradd($mysqli ,$username , $snumber){
    $sql = "INSERT INTO users(username , snumber) VALUES(? , ?)";
    $mysqli_stmt = $mysqli->prepare($sql); //准备预处理语句

    //s 代表 string 类型,i 代表 int
    $mysqli_stmt->bind_param('si' , $username, $snumber);
    //执行预处理语句
    if ($mysqli_stmt->execute()) {
    echo PHP_EOL;
    echo "<script>window.location.href='../../views/admin/feedback.html'</script>";
    } else {
    echo $mysqli_stmt->error; //执行失败，错误信息
    }
    $mysqli_stmt->free_result();
    $mysqli_stmt->close();
}



$mysqli->close();


