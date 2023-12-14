<?php
include "../connection.php";

$question_id = $_POST['question_id'];

$q = "delete o,q FROM questions q 
inner join options o on o.question_id=q.question_id 
WHERE q.question_id =  $question_id";
// die($q);

if (mysqli_query($conn, $q)) {
    $response = [
        'status' => 'ok',
        'success' => true,
        'message' => 'Record deleted succesfully!'
    ];
    print_r(json_encode($response));
} else {
    $response = [
        'status' => 'ok',
        'success' => false,
        'message' => 'Record deleted failed!'
    ];
    print_r(json_encode($response));
}
