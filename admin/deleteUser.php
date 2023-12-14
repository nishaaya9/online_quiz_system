<?php
include "../connection.php";

$id = $_POST['id'];
$q = "DELETE FROM users WHERE `users`.`id` = $id";

if (mysqli_query($conn, $q)) {
    $response = [
        'status' => 'ok',
        'success' => true,
        'message' => 'Record deleted succesfully!'
    ];
    print_r(json_encode($response));
} else {
    $response = [
        'status' => 'ok',
        'success' => false,
        'message' => 'Record deleted failed!'
    ];
    print_r(json_encode($response));
}
