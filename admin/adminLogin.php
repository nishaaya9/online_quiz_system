<?php
session_start();
include "../connection.php";

$email = $_POST['email'];
$password = $_POST['password'];

$q = "select * from users where email='$email' and password='$password' and r_id=1";
$res = mysqli_query($conn, $q);

if (mysqli_num_rows($res) > 0) {
    $_SESSION['email'] = $email;
    echo json_encode(array("statusCode" => 200));
} else {
    echo json_encode(array("statusCode" => 201));
}
