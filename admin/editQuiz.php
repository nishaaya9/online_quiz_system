<?php
include "../connection.php";

$id = $_POST['quiz_id'];
$title = $_POST['title'];
$description = $_POST['description'];
$time_limit = $_POST['time_limit'];

$q = "UPDATE `quizzes` SET  `title` = '$title', `description` = '$description', `time_limit` = '$time_limit' WHERE `quizzes`.`quiz_id` = $id";
if (mysqli_query($conn, $q)) {
    $response = [
        'status' => 'ok',
        'success' => true,
        'message' => 'Record updated succesfully!'
    ];
    echo json_encode($response);
} else {
    $response = [
        'status' => 'ok',
        'success' => false,
        'message' => 'Record updated failed!'
    ];
    echo json_encode($response);
}
