<?php
include "session-check.php";
include "connection.php";

$user_id = $_SESSION['id'];
$quiz_id = $_GET['quiz_id'];

$q3 = "UPDATE `user_quiz_assignments` SET `quiz_status` = '2' WHERE user_id = '$user_id' && quiz_id = '$quiz_id'";
$res3 = mysqli_query($conn, $q3);

$q = "SELECT * FROM quizzes
inner join quiz_question_association on quizzes.quiz_id=quiz_question_association.quiz_id
where quiz_question_association.quiz_id=$quiz_id";
$res = mysqli_query($conn, $q);
$totalQuestions = mysqli_num_rows($res);

$questions_id = [];
$options_id = [];

$q = "SELECT * FROM user_quiz_progress WHERE user_id='$user_id' AND quiz_id='$quiz_id'";
$res = mysqli_query($conn, $q);
if (mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_assoc($res)) {
        $questions_id[] = $row['question_id'];
        $options_id[] = $row['selected_option_id'];
    }
}

$score = 0;

foreach ($questions_id as $index => $question_id) {
    $selected_option_id = $options_id[$index];

    $q = "SELECT * FROM options WHERE question_id='$question_id' AND is_correct=1";
    $res = mysqli_query($conn, $q);
    $row = mysqli_fetch_assoc($res);
    $correct_option = $row['option_id'];

    if ($selected_option_id == $correct_option) {
        $score++;
    }
}

$totalScore = $score;

$q = "SELECT * FROM quiz_results WHERE user_id='$user_id' AND quiz_id='$quiz_id'";
$res = mysqli_query($conn, $q);
if (mysqli_num_rows($res) == 0) {
    $query = "INSERT INTO quiz_results (`user_id`, `quiz_id`, `score`) VALUES ('$user_id', '$quiz_id', '$totalScore')";
    $result = mysqli_query($conn, $query);
}

$q = "SELECT * FROM quiz_results
INNER JOIN quizzes ON quiz_results.quiz_id=quizzes.quiz_id
WHERE quiz_results.user_id='$user_id' AND quiz_results.quiz_id='$quiz_id'";
$res = mysqli_query($conn, $q);
$row = mysqli_fetch_assoc($res);
?>

<section class="content pb-3">
    <div class="container-fluid h-100">
        <div class="card card-row card-primary m-auto" style="width:35%;">
            <div class="card-header d-flex justify-content-center fw-bold fs-3" style="background-color: #17a2b8 !important;">
                Result
            </div>
            <div class="card-body">
                <div class="card card-primary card-outline" style="border-top: 3px solid #17a2b8 !important;">
                    <div class="card-header">
                        <h5 class="card-title">Quiz: <?php echo $row['title'] ?></h5>
                    </div>
                    <div class="card-header">
                        <h5 class="card-title">Score: <?php echo $row['score'] . '/' . $totalQuestions ?></h5>
                    </div>
                </div>
                <div>
                    <a href="home"><button class="btn btn-secondary">Back</button></a>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        $('#quizTitle').hide();
        $('#currentQuestion').hide();
        $('#timeLeft').hide();
        $('#myForm').hide();
        $('#nextButton').hide();
        $('.timer').hide();
    });
</script>