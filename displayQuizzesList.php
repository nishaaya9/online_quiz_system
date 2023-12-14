<?php
session_start();
include "connection.php";

$q = "SELECT * FROM user_quiz_assignments
INNER JOIN quizzes ON user_quiz_assignments.quiz_id = quizzes.quiz_id 
WHERE user_quiz_assignments.user_id = " . $_SESSION['id'];
$res = mysqli_query($conn, $q);

$i = 1;
while ($row = mysqli_fetch_assoc($res)) {
    $quizID = $row['quiz_id'];

    $query = "SELECT * FROM user_quiz_assignments WHERE quiz_id = '$quizID' AND user_id = " . $_SESSION['id'];
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $progress_row = mysqli_fetch_assoc($result);
        $status = $progress_row['quiz_status'];

        echo "<tr>";
        echo "<td>{$i}</td>";
        echo "<td>{$row['title']}</td>";
        echo "<td>{$row['time_limit']} Minutes</td>";
        echo "<td>";

        if ($status == 1) {
            echo "<a href='questionList?quiz_id={$quizID}'><button type='button' class='btn btn-warning'>Continue</button></a>";
        } elseif ($status == 2) {
            echo "<a href='viewResult?quiz_id={$quizID}'><button type='button' class='btn btn-success'>View Result</button></a>";
        } else {
            echo "<a href='questionList?quiz_id={$quizID}'><button type='button' class='btn btn-primary'>Take Quiz</button></a>";
        }

        echo "</td>";
        echo "</tr>";
        $i++;
    }
}
