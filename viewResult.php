<?php
include "session-check.php";
include "header.php";
include "navbar.php";
include "sidebar.php";
include "connection.php";

$user_id = $_SESSION['id'];
$quiz_id = $_GET['quiz_id'];

$q = "SELECT * FROM quizzes
inner join quiz_question_association on quizzes.quiz_id=quiz_question_association.quiz_id
where quiz_question_association.quiz_id=$quiz_id";
$res = mysqli_query($conn, $q);
$totalQuestions = mysqli_num_rows($res);

//show result
$q2 = "SELECT * FROM quiz_results
inner join quizzes on quiz_results.quiz_id=quizzes.quiz_id
WHERE quiz_results.user_id='$user_id' AND quiz_results.quiz_id='$quiz_id'";
$res2 = mysqli_query($conn, $q2);
if (mysqli_num_rows($res2) > 0) {
    $row = mysqli_fetch_assoc($res2);
?>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        </section>
        <!-- Main content -->
        <section class="content pb-3">
            <div class="container-fluid h-100">
                <div class="card card-row card-primary m-auto" style="width:35%;">
                    <div class="card-header d-flex justify-content-center fw-bold fs-3" style="background-color: #17a2b8 !important;">
                        Result
                    </div>
                    <div class="card-body">
                        <div class="card card-primary card-outline" style="border-top: 3px solid #17a2b8 !important;">
                            <div class="card-header">
                                <h5 class="card-title">Quiz : <?php echo $row['title'] ?></h5>
                            </div>
                            <div class="card-header">
                                <h5 class="card-title">Score : <?php echo $row['score'] . '/' . $totalQuestions ?></h5>
                            </div>
                        </div>
                        <div>
                            <a href="home"><button class="btn btn-secondary">Back</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php
} else {
    include "no-quiz-assigned.php";
}
include "footer.php";
?>