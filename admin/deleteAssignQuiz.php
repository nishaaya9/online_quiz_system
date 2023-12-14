<?php
include "../connection.php";

$user_quiz_assignments_id = $_POST['user_quiz_assignments_id'];

$q = "DELETE FROM user_quiz_assignments WHERE user_quiz_assignments_id = $user_quiz_assignments_id";
mysqli_query($conn, $q);

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
