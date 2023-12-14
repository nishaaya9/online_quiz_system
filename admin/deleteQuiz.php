<?php
include "../connection.php";

$quiz_id = $_POST['quiz_id'];

$tables = array(
    "user_quiz_progress",
    "user_quiz_assignments",
    "quiz_results",
    "quiz_question_association",
    "quiz_assignments",
    "quizzes"
);

foreach ($tables as $table) {
    $q = "DELETE FROM $table WHERE quiz_id = $quiz_id";
    mysqli_query($conn, $q);
}

if (mysqli_affected_rows($conn) > 0) {
    $response = [
        'status' => 'ok',
        'success' => true,
        'message' => 'Records deleted successfully!'
    ];
    print_r(json_encode($response));
} else {
    $response = [
        'status' => 'ok',
        'success' => false,
        'message' => 'No records were deleted!'
    ];
    print_r(json_encode($response));
}
