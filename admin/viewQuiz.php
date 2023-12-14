<?php
// include "session-check.php";
include "../connection.php";

$quiz_id = $_POST['quiz_id'];
$q = "select * FROM quizzes WHERE `quizzes`.`quiz_id` = $quiz_id";
$res = mysqli_query($conn, $q);
$row = mysqli_fetch_assoc($res);
print_r(json_encode($row));  //encode