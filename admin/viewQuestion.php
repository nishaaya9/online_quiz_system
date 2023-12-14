<?php
include "../connection.php";

$question_id = $_POST['question_id'];

$q = "SELECT questions.*, options.option_id, options.options, options.is_correct
      FROM questions
      INNER JOIN options ON questions.question_id = options.question_id
      WHERE questions.question_id = '$question_id'";

$res = mysqli_query($conn, $q);

$data = [];
while ($row = mysqli_fetch_assoc($res)) {
    array_push($data, $row);
}
print_r(json_encode($data)); // Encode and return the data

