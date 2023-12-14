<?php
include "../connection.php";

$association_id = $_POST['association_id'];

$tables = array(
    "user_quiz_progress",
    "quiz_assignments",
    "quiz_question_association",
);

foreach ($tables as $table) {
    $q = "DELETE FROM $table WHERE association_id = $association_id";
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
