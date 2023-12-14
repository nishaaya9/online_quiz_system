<?php
include "../connection.php";

$q = "SELECT quizzes.title,
SUM(CASE WHEN user_quiz_assignments.quiz_status = 2 THEN 1 ELSE 0 END) AS completed_count,
SUM(CASE WHEN user_quiz_assignments.quiz_status = 1 THEN 1 ELSE 0 END) AS in_progress_count
FROM user_quiz_assignments
INNER JOIN quizzes ON user_quiz_assignments.quiz_id = quizzes.quiz_id
GROUP BY user_quiz_assignments.quiz_id";

$res = mysqli_query($conn, $q);

$data = "";
$i = 1;
while ($row = mysqli_fetch_assoc($res)) {
$data .= "<tr>
    <td>$i</td>
    <td>{$row['title']}</td>
    <td>{$row['completed_count']}</td>
    <td>{$row['in_progress_count']}</td>
</tr>";
$i++;
}
echo $data;