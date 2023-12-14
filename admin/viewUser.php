<?php
include "../connection.php";

$id = $_POST['id'];
$q = "select * FROM users WHERE `users`.`id` = $id";
$res = mysqli_query($conn, $q);
$row = mysqli_fetch_assoc($res);
print_r(json_encode($row));  //encode