<?php
include "../connection.php";

$question = $_POST['question'];
$number = count($_POST["name"]);
$correct_option = $_POST['option'];

$q = "INSERT INTO `questions` (`questions`) VALUES ('$question')";
$res = mysqli_query($conn, $q);
$lastId = $conn->insert_id;

if ($res) {
    if ($number > 0) {
        for ($i = 0; $i < $number; $i++) {
            if ($i == $correct_option) {
                $is_correct = "1";
            } else {
                $is_correct = "0";
            }
            if (trim($_POST["name"][$i] != '')) {
                $sql = "INSERT INTO `options`(`question_id`,`is_correct`,`options`) VALUES('$lastId','$is_correct','" . mysqli_real_escape_string($conn, $_POST["name"][$i]) . "')";
                $res2 = mysqli_query($conn, $sql);
                // die();
            }
        }
        if ($res2) {
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
    }
}

