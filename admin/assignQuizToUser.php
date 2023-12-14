<?php
include "../connection.php";

$users = $_POST['user_id'];
$quizzes = $_POST['quiz_id'];

foreach ($users as $user) {
    foreach ($quizzes as $quiz) {
        $q_check_questions = "SELECT * FROM quiz_question_association WHERE quiz_id='$quiz'";
        $res_check_questions = mysqli_query($conn, $q_check_questions);

        if (mysqli_num_rows($res_check_questions) > 0) {
            $q_check_user_quiz_assignment = "SELECT * FROM user_quiz_assignments WHERE user_id='$user' AND quiz_id='$quiz'";
            $res_check_user_quiz_assignment = mysqli_query($conn, $q_check_user_quiz_assignment);

            if (mysqli_num_rows($res_check_user_quiz_assignment) > 0) {
                $response = [
                    'status' => 'ok',
                    'success' => true,
                    'message' => 'The quiz is already assigned to the user'
                ];
                print_r(json_encode($response));
            } else {
                $q_insert_user_quiz_assignment = "INSERT INTO user_quiz_assignments (user_id, quiz_id) VALUES ('$user', '$quiz')";
                $res_insert_user_quiz_assignment = mysqli_query($conn, $q_insert_user_quiz_assignment);

                if ($res_insert_user_quiz_assignment) {
                    $response = [
                        'status' => 'ok',
                        'success' => true,
                        'message' => 'Assigned Quiz To User Successfully!'
                    ];
                    print_r(json_encode($response));
                } else {
                    $response = [
                        'status' => 'error',
                        'success' => false,
                        'message' => 'Quiz assignment failed!'
                    ];
                    print_r(json_encode($response));
                }
            }
        } else {
            $response = [
                'status' => 'error',
                'success' => false,
                'message' => 'No questions assigned to this quiz. Cannot assign the quiz to the user'
            ];
            print_r(json_encode($response));
        }
    }
}
foreach ($users as $user) {
    foreach ($quizzes as $quiz) {
        $q3 = "select * from quiz_assignments where user_id='$user' and quiz_id='$quiz'";
        $res3 = mysqli_query($conn, $q3);
        if (mysqli_num_rows($res3) > 0) {
            echo "<script>alert('The quiz is already assigned to the user.')</script>";
        } else {
            $q4 = "INSERT INTO quiz_assignments (user_id, quiz_id, association_id, attempted) SELECT $user, $quiz, association_id, 0 FROM quiz_question_association where quiz_id='$quiz'";
            $res4 = mysqli_query($conn, $q4);
        }
    }
}
