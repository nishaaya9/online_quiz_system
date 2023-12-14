<?php
session_start();
include "connection.php";

$user_id = $_SESSION['id'];
$quiz_id = $_POST['quiz_id'];
$association_id = $_POST['association_id'];
$question_id = $_POST['question_id'];
$selected_option_id = $_POST['option_id'];

//insertData
$q = "INSERT INTO `user_quiz_progress` (`user_id`, `quiz_id`, `association_id`,`question_id`,`selected_option_id`) VALUES ('$user_id', '$quiz_id', '$association_id','$question_id','$selected_option_id')";
$res = mysqli_query($conn, $q);

$q2 = "UPDATE `quiz_assignments` SET `attempted` = '1' WHERE user_id = '$user_id' && quiz_id = '$quiz_id' && association_id = '$association_id'";
$res2 = mysqli_query($conn, $q2);
