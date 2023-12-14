<?php
include "../connection.php";

//Query
$q = "select * from user_quiz_assignments 
inner join users on users.id=user_quiz_assignments.user_id
inner join quizzes on quizzes.quiz_id=user_quiz_assignments.quiz_id order by user_quiz_assignments_id";
$res = mysqli_query($conn, $q);

$data = "";
$i = 1;
while ($row = mysqli_fetch_assoc($res)) {
    $data .= "<tr>
        <td>$i</td>
        <td>{$row['name']}</td>
        <td>{$row['title']}</td>
        <td><button type='button' class='btn btn-danger' id='delete-btn' data-bs-toggle='modal' data-bs-target='#deleteAssignQuizzesModal' data-id='{$row["user_quiz_assignments_id"]}'>Delete</button></td>
        </tr>";
        $i++;
}
echo $data;
