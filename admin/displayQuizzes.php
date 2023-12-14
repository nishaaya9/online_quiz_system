<?php
include "../connection.php";

//Query
$q = "SELECT * FROM quizzes";
$res = mysqli_query($conn, $q);

$data = "";
$i=1;
while ($row = mysqli_fetch_assoc($res)) {
    $data .= "<tr>
        <td>$i</td>
        <td>{$row['title']}</td>
        <td>{$row['description']}</td>
        <td>{$row['time_limit']} Minutes</td>
        <td><button type='button' id='quiz-edit-btn' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#editQuizModal' data-id='{$row["quiz_id"]}'>Edit</button>
        <button type='button' class='btn btn-danger' id='quiz-delete-btn' data-bs-toggle='modal' data-bs-target='#deleteQuizModal' data-id='{$row["quiz_id"]}'>Delete</button></td>
        </tr>";
        $i++;
}
echo $data;
?>

<script>
    
</script>