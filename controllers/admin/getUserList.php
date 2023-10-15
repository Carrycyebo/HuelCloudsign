<?php


function getUserList($mysqli)
{
    $arr = array();

    $sql = "SELECT users.uid , users.username , users.snumber , users.is_signed , users.signed_time FROM users ";
    $mysqli_stmt = $mysqli->prepare($sql);

    if ($mysqli_stmt->execute()) {
        //bind_result() 绑定结果s集中的值到变量
        $uid = null;
        $users = null;
        $snumber = null;
        $is_signed = null;
        $signed_time = null;
        $mysqli_stmt->bind_result($uid , $users , $snumber , $is_signed , $signed_time);
        //遍历结果集
        while ($mysqli_stmt->fetch()) {
            array_push($arr,array($uid , $users , $snumber , $is_signed , $signed_time));

        }

    }
    //释放结果集
    $mysqli_stmt->free_result();
    $mysqli_stmt->close();
    $mysqli->close();

    return $arr;

    
}

