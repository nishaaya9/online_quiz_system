<?php
include "../connection.php";

$title = $_POST['title'];
$description = $_POST['description'];
$time_limit = $_POST['time_limit'];

$q = "INSERT INTO `quizzes` (`title`, `description`, `time_limit`) VALUES ('$title', '$description', '$time_limit')";

if (mysqli_query($conn, $q)) {
    $response = [
        'status' => 'ok',
        'success' => true,
        'message' => 'Inserted succesfully!'
    ];
    print_r(json_encode($response));
} else {
    $response = [
        'status' => 'error',
        'success' => false,
        'message' => 'Record created failed!'
    ];
    print_r(json_encode($response));
}
?>