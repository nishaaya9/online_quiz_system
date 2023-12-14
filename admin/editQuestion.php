<?php
include "../connection.php";

$question = $_POST['e_question'];
$question_id = $_POST["question_id"];
$number = count($_POST["e_name"]);
$correct_option = $_POST['e_option'];

$q = "UPDATE `questions` SET `questions` = '$question' WHERE `questions`.`question_id`='$question_id'";
$res = mysqli_query($conn, $q);

$q2 = "DELETE FROM `options` WHERE `options`.`question_id` = '$question_id'";
mysqli_query($conn, $q2);

if ($number > 0) {
    for ($i = 0; $i < $number; $i++) {
        if ($i == $correct_option) {
            $is_correct = "1";
        } else {
            $is_correct = "0";
        }
        if (trim($_POST["e_name"][$i] != '')) {
            $sql = "INSERT INTO `options`(`question_id`,`is_correct`,`options`) VALUES('$question_id','$is_correct','" . mysqli_real_escape_string($conn, $_POST["e_name"][$i]) . "')";
            $res2 = mysqli_query($conn, $sql);
            // die();
        }
    }
    if ($res2) {
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
}
