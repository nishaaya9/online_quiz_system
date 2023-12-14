<?php
include "../connection.php";

$quizzes = $_POST['quiz_id'];
$questions = $_POST['question_id'];
$allAssigned = true; // Flag to track if all assignments are successful

foreach ($quizzes as $quiz) {
    foreach ($questions as $question) {
        $q = "SELECT * FROM quiz_question_association WHERE quiz_id='$quiz' AND question_id='$question'";
        $res = mysqli_query($conn, $q);

        if (mysqli_num_rows($res) === 0) {
            $q_insert = "INSERT INTO quiz_question_association (quiz_id, question_id) VALUES ('$quiz', '$question')";
            $res_insert = mysqli_query($conn, $q_insert);
        } else {
            $allAssigned = false; // Update flag if any assignment fails
        }
    }
}

if ($allAssigned) {
    $response = [
        'status' => 'ok',
        'success' => true,
        'message' => 'Questions assigned to quizzes successfully!'
    ];
    print_r(json_encode($response));
} else {
    $response = [
        'status' => 'error',
        'success' => false,
        'message' => 'Some assignments failed or already exist!'
    ];
    print_r(json_encode($response));
}
