<?php

include_once "../../controllers/admin/getUserList.php";
include_once "../../models/core_mysql.php";

$arr = getUserList($mysqli);

echo json_encode($arr);