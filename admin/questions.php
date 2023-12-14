<?php
include "checkSession.php";
include "header.php";
include "navbar.php";
include "sidebar.php";
include "../connection.php";
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="col-md-12 mt-2" style="float:left">
                <div>
                    <button type='button' class='btn btn-primary mt-2' data-bs-toggle='modal' data-bs-target='#addDataModal'>Add Question</button>
                </div>
            </div>

            <!-- addmodal -->
            <div class="modal fade" id="addDataModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Question</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" id="questionAddData">
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label>Question :</label>
                                    <input type="text" name="question" id="question" class="form-control" required>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="field">
                                        <tr>
                                            <label>Options :</label>
                                            <td><input class="form-check-input" style="margin-left:-0.25rem !important; margin-top: 11px !important;" type="radio" name="option" value="0" id="flexRadioDefault1"></td>
                                            <td><input type="text" name="name[]" class="form-control name_list" required></td>
                                            <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Add</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- editmodal -->
            <div class="modal fade" id="editQuestionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form method="post" id="questionEditData">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Question</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="question_id" id="question_id">
                                <div class="form-group mb-3">
                                    <label>Question :</label>
                                    <input type="text" name="e_question" id="e_question" class="form-control">
                                </div>
                                <div class="table-responsive">
                                    <label>Options :</label>
                                    <button type="button" name="edit" id="edit" class="btn btn-success">+</button>
                                    <table class="table table-bordered mt-1" id="e_field">

                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- deleteModal -->
            <div class=" modal fade" id="deleteQuestionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class=" modal-body">
                            <p>Are you sure you want to delete these Records?</p>
                            <p class="text-warning"><small>This action cannot be undone.</small></p>
                        </div>
                        <input type="hidden" id="delete_id">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                            <button type="button" class="btn btn-danger" onclick="deleteQuestion()">Yes</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- table -->
            <div class="col-md-12 mt-2" style="float:left">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- table -->
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Questions</th>
                                            <th>Total Used In Quiz</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="questionsData">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- jquery/ajax code -->
            <script>
                //displayData
                $(document).ready(function() {
                    questionsDisplay();
                });

                //insert
                var i = 1;
                $('#add').click(function() {
                    $('#field').append('<tr id="row' + i + '" class="option_row"><td><input class="form-check-input" style="margin-left:-0.25rem !important; margin-top: 11px !important;" type="radio" name="option" value="' + i + '" id="flexRadioDefault1"></td><td><input type="text" name="name[]" class="form-control name_list" required></td><td><button type="button" name="remove" id="' + i + '"   class="btn btn-danger btn_remove">X</button></td></tr>');
                    i++;
                });
                $(document).on('click', '.btn_remove', function() {
                    var button_id = $(this).attr("id");
                    $('#row' + button_id + '').remove();
                });

                $("#questionAddData").on('submit', function(e) {
                    e.preventDefault();
                    const selectedAnswer = $('input[name="option"]:checked');
                    // console.log("selected answer", selectedAnswer.length);
                    if (selectedAnswer.length == 1) {
                        $.ajax({
                            type: 'POST',
                            url: 'admin/addQuestionData',
                            data: new FormData(this),
                            dataType: 'json',
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function(data) {
                                var response = JSON.parse(JSON.stringify(data));
                                if (response.success) {
                                    alert(response.message);
                                    // $("#addDataModal").modal('hide');
                                    // questionsDisplay();
                                    // $('#questionAddData').trigger("reset");
                                    location.reload();
                                } else {
                                    alert(response.message);
                                }
                            }
                        });
                    } else {
                        e.preventDefault();
                        alert("Please select an answer.");
                    }
                });

                //view data
                $(document).on("click", "#question-edit-btn", function() {
                    var question_id = $(this).data("id");
                    $("#question_id").val(question_id);
                    $.ajax({
                        url: "admin/viewQuestion",
                        type: 'POST',
                        data: {
                            question_id: question_id,
                        },
                        success: function(data) {
                            var response = JSON.parse(data);
                            $('#e_question').val(response[0].questions);
                            $('#e_field').empty();

                            response.forEach(function(option, index) {
                                var optionHTML = '<tr id="row2' + index + '">';
                                optionHTML += '<td><input class="form-check-input" style="margin-left:-0.25rem !important; margin-top: 11px !important;" type="radio" name="e_option" value="' + option.option_id + '"';

                                // Check if the option is the correct answer and pre-select it
                                if (option.is_correct === '1') {
                                    optionHTML += ' checked';
                                }

                                optionHTML += '></td>';
                                optionHTML += '<td><input type="text" name="e_name[]" value="' + option.options + '" class="form-control name_list" /></td>';
                                optionHTML += '<td><button type="button" style="background:#dc3545 !important; padding:5px 10px !important;" name="remove" id="' + index + '" class="btn btn-danger e_btn_remove">X</button></td>';
                                optionHTML += '</tr>';

                                $('#e_field').append(optionHTML);
                            });
                        }
                    });
                });

                //edit
                var i = 1;
                $('#edit').click(function() {
                    i++;
                    $('#e_field').append('<tr id="row2' + i + '" class="option_row"><td><input class="form-check-input" style="margin-left:-0.25rem !important; margin-top: 11px !important;" type="radio" name="e_option" value="' + i + '" id="flexRadioDefault1"></td><td><input type="text" name="e_name[]" class="form-control name_list" required></td><td><button type="button" name="remove" id="' + i + '" style="background:#dc3545 !important; padding:5px 10px !important;" class="btn btn-danger e_btn_remove">X</button></td></tr>');
                });
                $(document).on('click', '.e_btn_remove', function() {
                    var button_id = $(this).attr("id");
                    $('#row2' + button_id + '').remove();
                });

                // editData
                $(document).ready(function() {
                    $("#questionEditData").on('submit', function(e) {
                        e.preventDefault();
                        $.ajax({
                            type: 'POST',
                            url: 'admin/editQuestion',
                            data: new FormData(this),
                            dataType: 'json',
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function(data) {
                                var response = JSON.parse(JSON.stringify(data));
                                // console.log(response);
                                if (response) {
                                    alert(response.message);
                                    // $("#editQuestionModal").modal('hide');
                                    // questionsDisplay();
                                    location.reload();
                                }
                            }
                        });
                    });
                });

                //deleteData
                $(document).on("click", "#question-delete-btn", function() {
                    var question_id = $(this).data("id");
                    var question_id = $('#delete_id').val(question_id);
                });

                function deleteQuestion() {
                    var question_id = $('#delete_id').val();
                    // alert(id);
                    $('#deleteQuestionModal').modal('hide');
                    $.ajax({
                        url: "admin/deleteQuestion",
                        type: 'post',
                        data: {
                            question_id: question_id
                        },
                        success: function(data) {
                            var response = JSON.parse(data);
                            // var quiz_id = $("#title").val();
                            // alert(quiz_id);
                            // questionsDisplay(quiz_id);
                            alert(response.message);
                            location.reload();
                        }
                    });
                }

                function questionsDisplay() {
                    $.ajax({
                        url: "admin/displayQuestions",
                        type: "post",
                        success: function(data) {
                            $("#questionsData").html(data);
                            $("#example1").DataTable({
                                "paging": true,
                                "lengthChange": true,
                                "searching": true,
                                "bDestroy": true
                            });
                        }
                    });
                }
            </script>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
include "footer.php";
?>