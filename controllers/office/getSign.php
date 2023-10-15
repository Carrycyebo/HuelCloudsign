<?php

include_once "../../models/core_mysql.php";

$username = $_GET["username"];
$snumber =  $_GET["snumber"];


$rssnumber = getUserIsExist($mysqli , $username , $snumber);
echo $rssnumber;
updateSign($mysqli , $rssnumber);

function getUserIsExist($mysqli, $username, $snumber)
{
    $sql = "SELECT snumber FROM users WHERE username = ? and snumber = ?";
    $mysqli_stmt = $mysqli->prepare($sql);

    $mysqli_stmt->bind_param('ss', $username, $snumber);
    if ($mysqli_stmt->execute()) {
        //bind_result() 绑定结果集中的值到变量
        // $mysqli_stmt->bind_result($username, $snumber);
        //遍历结果集
        // var_dump($mysqli_stmt->fetch());
        $res = $mysqli_stmt->fetch();
        if ($res != null) {
            echo '姓名: ' . $username;
            echo '<br/>学号: ' . $snumber;
            echo "<br/>";
        }else{
            echo "<script>alert('签到失败，姓名或学号错误！');window.location.href='../../index.html'</script>";
            return null;
        }
    }
    //释放结果集
    $mysqli_stmt->free_result();
    $mysqli_stmt->close();
    return $snumber;
}

function updateSign($mysqli  , $snumber)
{
    $is_signed = 1;
    $Nowtime = date('Y-m-d h:i:s',time());
    $sql = " UPDATE users SET is_signed = ? , signed_time = ? WHERE snumber = ?";
    $mysqli_stmt = $mysqli->prepare($sql); 
    $mysqli_stmt->bind_param('iss',$is_signed , $Nowtime ,  $snumber);
    if($mysqli_stmt->execute())
    {
        echo PHP_EOL;
        echo "<script>window.location.href='../../views/office/feedback.html'</script>";
    }
    else
    {
        echo $mysqli_stmt->error;
    }
}

$mysqli->close();
