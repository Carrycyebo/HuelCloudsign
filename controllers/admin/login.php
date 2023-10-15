<?php
include_once "../../models/core_mysql.php";

$adminName = $_POST['adminName'];
$adminPasswd = $_POST['adminPasswd'];

getAdmin($mysqli , $adminName ,$adminPasswd);

function getAdmin($mysqli , $adminName ,$adminPasswd){
    $sql = "SELECT admin_Name FROM admins WHERE admin_Name = ? and admin_Passwd = ?";
    $mysqli_stmt = $mysqli->prepare($sql);

    $mysqli_stmt->bind_param('ss', $adminName, $adminPasswd);
    if ($mysqli_stmt->execute()) {
        //bind_result() 绑定结果集中的值到变量
        // $mysqli_stmt->bind_result($username, $snumber);
        //遍历结果集

        $res = $mysqli_stmt->fetch();

        if ($res) {
            $_SESSION['adminName'] = $adminName;
            echo "<script>window.location.href='../../views/admin/index.php'</script>";
        }
        else
        {
            echo "<script>alert('登录失败！'); window.location.href='../../views/admin/index.php'</script>";
        }
        
    }
    //释放结果集
    $mysqli_stmt->free_result();
    $mysqli_stmt->close();
}


$mysqli->close();
