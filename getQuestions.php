<?php
include "session-check.php";
include "connection.php";

$quiz_id = $_GET['quiz_id'];
$user_id = $_SESSION['id'];

$q = "SELECT * FROM user_quiz_assignments WHERE user_id=$user_id AND quiz_id=$quiz_id AND quiz_status=2";
$r = mysqli_query($conn, $q);
if (mysqli_num_rows($r) == 0) {
    $q = "SELECT * FROM quizzes
    inner join quiz_question_association on quizzes.quiz_id=quiz_question_association.quiz_id
    where quiz_question_association.quiz_id=$quiz_id";
    $result = mysqli_query($conn, $q);
    $row = mysqli_fetch_assoc($result);
    $association_id = $row['association_id'];

    $q2 = "SELECT * FROM quiz_assignments
    INNER JOIN users ON quiz_assignments.user_id=users.id
    INNER JOIN quizzes ON quiz_assignments.quiz_id=quizzes.quiz_id
    INNER JOIN quiz_question_association ON quiz_assignments.association_id=quiz_question_association.association_id
    INNER JOIN questions ON quiz_question_association.question_id=questions.question_id
    where quiz_assignments.user_id='$user_id' and quiz_assignments.quiz_id='$quiz_id' and quiz_assignments.attempted=0 limit 1";
    $question = mysqli_query($conn, $q2);
?>

    <form id="myForm" method="post">
        <?php
        while ($row = mysqli_fetch_assoc($question)) {
        ?>
            <input type="hidden" name="quiz_id" value="<?php echo $quiz_id; ?>">
            <input type="hidden" name="association_id" value="<?php echo $row['association_id'] ?>">
            <ul class=" list-group que">
                <li class="list-group-item" style="background-color: #6c757d;color:#fff">
                    <input type="hidden" name="question_id" value="<?php echo $row['question_id'] ?>"><?php echo $row['questions'] ?>
                </li>
                <?php
                $q = "SELECT * FROM options where options.question_id = '" . $row['question_id'] . "' order by rand()";
                $option = mysqli_query($conn, $q);
                ?>
                <ul class='list-group form-check'>
                    <?php while ($option_row = mysqli_fetch_assoc($option)) { ?>
                        <label class="form-check-label list-group-item form-check px-3 d-flex align-items-center options" for="<?php echo $option_row['option_id'] ?>">
                            <input class="form-check-input ms-1 mt-0" style="border: 1px solid gray;" type="radio" name="option_id" id="<?php echo $option_row['option_id'] ?>" value="<?php echo $option_row['option_id'] ?>">
                            <h6 class="mb-0" style="margin-left: 30px;"><?php echo " " . $option_row['options'] ?></h6>
                        </label>
                    <?php } ?>
                </ul>
            </ul>
        <?php
        }
        ?>
    </form>

<?php
} else {
    header("location:getResult?quiz_id=$quiz_id");
}
?>