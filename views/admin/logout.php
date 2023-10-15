<?php
include_once "../../models/core_mysql.php";
unset($_SESSION['adminName']);
session_destroy();

echo "<script>alert('账号已注销！');window.location.href='./login.html'</script>";

?>