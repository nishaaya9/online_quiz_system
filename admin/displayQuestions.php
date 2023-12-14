<?php
include "../connection.php";

//Query
$q = "SELECT COUNT(quiz_question_association.question_id) as total_used_in_quiz,questions.question_id,questions
FROM quiz_question_association 
INNER JOIN questions ON quiz_question_association.question_id = questions.question_id 
GROUP BY quiz_question_association.question_id";
$res = mysqli_query($conn, $q);

$data = "";
$i = 1;
while ($row = mysqli_fetch_assoc($res)) {
    $data .= "<tr>
        <td>$i</td>
        <td>{$row['questions']}</td>
        <td>{$row['total_used_in_quiz']}</td>
        <td><button type='button' id='question-edit-btn' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#editQuestionModal' data-id='{$row["question_id"]}'>Edit</button>
        <button type='button' id='question-delete-btn' class='btn btn-danger'  data-bs-toggle='modal' data-bs-target='#deleteQuestionModal' data-id='{$row["question_id"]}'>Delete</button></td>
        </tr>";
    $i++;
}
echo $data;
