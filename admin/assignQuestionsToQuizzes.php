<?php
include "../connection.php";

//Query
$q = "SELECT * FROM quiz_question_association 
INNER JOIN questions ON quiz_question_association.question_id=questions.question_id
INNER JOIN quizzes ON quiz_question_association.quiz_id=quizzes.quiz_id";
$res = mysqli_query($conn, $q);

$data = "";
$i = 1;
while ($row = mysqli_fetch_assoc($res)) {
    $data .= "<tr>
        <td>$i</td>
        <td>{$row['title']}</td>
        <td>{$row['questions']}</td>
        <td><button type='button' class='btn btn-danger' id='delete-btn' data-bs-toggle='modal' data-bs-target='#deleteAssignQuestionsModal' data-id='{$row["association_id"]}'>Delete</button></td>
        </tr>";
        $i++;
}
echo $data;
