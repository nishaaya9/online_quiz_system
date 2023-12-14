<?php
include "session-check.php";
include "header.php";
include "navbar.php";
include "sidebar.php";
include "connection.php";

$quiz_id = mysqli_real_escape_string($conn, $_GET['quiz_id']);
$user_id = mysqli_real_escape_string($conn, $_SESSION['id']);

$quiz_start_time = time();

$q7 = "SELECT * FROM user_quiz_assignments WHERE user_id='$user_id' AND quiz_id='$quiz_id'";
$res7 = mysqli_query($conn, $q7);
$row7 = mysqli_fetch_assoc($res7);

if (mysqli_num_rows($res7) != 0) {
    $q = "SELECT * FROM quizzes
        inner join quiz_question_association on quizzes.quiz_id=quiz_question_association.quiz_id
        where quiz_question_association.quiz_id=$quiz_id";
    $result = mysqli_query($conn, $q);
    $totalQuestions = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    $association_id = $row['association_id'];
    $title = $row['title'];
    $minutes = $row['time_limit'];
    $seconds = $minutes * 60;
    $startTime = $row7['quiz_start_time'];
    $endTime = $startTime + $seconds;

    $q8 = "SELECT * FROM user_quiz_assignments WHERE user_id='$user_id' AND quiz_id='$quiz_id' AND `quiz_status` = '0'";
    $res8 = mysqli_query($conn, $q8);

    if (mysqli_num_rows($res8) != 0) {
        $q5 = "UPDATE `user_quiz_assignments` SET `quiz_status` = '1',`quiz_start_time` = '$quiz_start_time' WHERE user_id = '$user_id' && quiz_id = '$quiz_id'";
        $res5 = mysqli_query($conn, $q5);
        $remainingTime = $seconds;
    } else {
        $currentTime = time();
        $remainingTime = $endTime - $currentTime;
    }
    $q9 = "SELECT * FROM quiz_assignments WHERE user_id='$user_id' AND quiz_id='$quiz_id' AND `attempted` = '1'";
    $res9 = mysqli_query($conn, $q9);
    $questionsCount = mysqli_num_rows($res9);
    if ($questionsCount == 0) {
        $currentQuestion = 1;
    } else {
        $currentQuestion = $questionsCount + 1;
    }
} else {
    include "no-quiz-assigned";
}
?>

<div class="content-wrapper">
    <section class="content-header">
    </section>
    <section class="content">
        <div class="container-fluid">
            <div id="container">
                <h2 id="quizTitle"><?php echo $title ?> Quiz</h2><br>
                <h4 id="currentQuestion">Question <?php echo $currentQuestion; ?> of <?php echo $totalQuestions; ?></h4><br>
                <div id="question_container"></div>
                <div class="mt-2">
                    <button class="btn btn-primary" type="submit" id="nextButton">Next</button>
                    <button class="btn btn-success ml-4" type="submit" id="submitButton" style="display:none">Submit</button>
                    <p style="float:right">
                        <font size="3" style="margin-left:100px;font-family:'typo';font-size:20px;font-weight:bold;color:darkred" id="timeLeft">Time Left : </font>
                        <span class="timer btn btn-default" style="margin-left:10px">
                            <font style="font-family:'typo';font-size:20px;font-weight:bold;color:darkblue" name="countdown" id="countdown"></font>
                        </span>
                    </p>
                </div>
            </div>
            <div id="result-container" style="display:none">
            </div>
        </div>
    </section>
</div>

<script>
    $(document).ready(function() {
        var total_questions = <?php echo $totalQuestions ?>;
        var currentQuestion = <?php echo $currentQuestion ?>;
        var isLastQuestion = false;
        var timer;

        getQuestions();
        updateRemainingTime();

        function getQuestions() {
            var quiz_id = <?php echo $quiz_id; ?>;
            $.ajax({
                type: "get",
                url: "getQuestions?quiz_id=" + quiz_id,
                success: function(data) {
                    $("#question_container").html(data);
                }
            });
        }

        function updateRemainingTime() {
            var currentTime = Math.floor(Date.now() / 1000);
            var remainingTime = <?php echo $remainingTime ?>;
            console.log("Remaining Time:" + remainingTime);

            timer = setInterval(function() {
                if (remainingTime <= 0) {
                    clearInterval(timer);
                    alert("Timer Expired");
                    showResult();
                } else {
                    const hours = Math.floor(remainingTime / 3600);
                    const minutes = Math.floor((remainingTime % 3600) / 60);
                    const seconds = remainingTime % 60;
                    $("#countdown").text(
                        (hours < 10 ? "0" : "") + hours + ":" + (minutes < 10 ? "0" : "") + minutes + ":" + (seconds < 10 ? "0" : "") + seconds
                    );
                    remainingTime--;
                }
            }, 1000);
        }

        function showResult() {
            var quiz_id = <?php echo $quiz_id; ?>;
            $.ajax({
                type: "post",
                url: "getResult?quiz_id=" + quiz_id,
                data: $("#myForm").serializeArray(),
                success: function(data) {
                    $('#container').hide();
                    $('#result-container').show();
                    $('#result-container').html(data);
                }
            });
        }

        $("#nextButton").click(function(e) {
            e.preventDefault();
            const selectedAnswer = $('input[name="option_id"]:checked');
            // console.log("selected answer", selectedAnswer.length);
            if (selectedAnswer.length == 1) {
                // if (selectedAnswer.length) {
                if (currentQuestion < total_questions) {
                    if (currentQuestion < Math.ceil(total_questions / 1)) {
                        currentQuestion++;
                        if (currentQuestion === total_questions) {
                            isLastQuestion = true;
                        }
                    }
                    var formData = $("#myForm").serialize();
                    $.ajax({
                        type: "post",
                        url: "user_quiz_progress",
                        data: $("#myForm").serialize(),
                        success: function(data) {
                            getQuestions();
                            if (isLastQuestion) {
                                $('#nextButton').addClass("disabled");
                                $('#submitButton').show();
                            }
                        }
                    });
                    $("#currentQuestion").text("Question " + currentQuestion + " of " + total_questions);
                }
            } else {
                e.preventDefault();
                alert("Please select an answer.");
                location.reload();
            }
        });
        if (currentQuestion === total_questions) {
            isLastQuestion = true;
            if (isLastQuestion) {
                $('#nextButton').addClass("disabled");
                $('#submitButton').show();
            }
        }

        $("#submitButton").click(function() {
            clearInterval(timer);
            $.ajax({
                type: "post",
                url: "user_quiz_progress",
                data: $("#myForm").serialize(),
                success: function(data) {
                    showResult();
                }
            });
        });
    });
</script>

<?php
include "footer.php";
?>