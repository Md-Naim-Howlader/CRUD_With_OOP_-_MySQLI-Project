<?php

include "config.php";
include "Classes/Database.php";
$id = $_GET['id'];

$db = new Database();

$sql = "DELETE FROM tbl_user WHERE id=$id";
$db->deleteUser($sql);





?>