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
                    <button type='button' class='btn btn-primary mt-2' data-bs-toggle='modal' data-bs-target='#addDataModal'>Add Quiz</button>
                </div>
            </div>

            <!-- addmodal -->
            <div class="modal fade" id="addDataModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Quiz</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" id="quizAddData">
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label>Title</label>
                                    <input type="text" name="title" id="title" class="form-control" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Description</label>
                                    <input type="text" name="description" id="description" class="form-control" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Time limit</label>
                                    <input type="text" name="time_limit" id="time_limit" class="form-control" required>
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
            <div class="modal fade" id="editQuizModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Quiz Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" id="editQuizData">
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label>Title</label>
                                    <input type="text" name="title" id="e_title" class="form-control" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Description</label>
                                    <input type="text" name="description" id="e_description" class="form-control" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Time limit</label>
                                    <input type="text" name="time_limit" id="e_time_limit" class="form-control" required>
                                </div>
                                <input type="hidden" name="quiz_id" id="e_quiz_id" class="form-control">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- deleteModal -->
            <div class=" modal fade" id="deleteQuizModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <button type="button" class="btn btn-danger" onclick="deleteQuiz()">Yes</button>
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
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Time limit</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="quizData">
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
                    quizDisplay();

                    //addData
                    $("#quizAddData").on('submit', function(e) {
                        e.preventDefault();
                        $.ajax({
                            type: 'POST',
                            url: 'admin/addQuizData',
                            data: new FormData(this),
                            dataType: 'json',
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function(data) {
                                var response = JSON.parse(JSON.stringify(data));
                                if (response) {
                                    alert(response.message);
                                    // $("#addDataModal").modal('hide');
                                    // quizDisplay();
                                    // $('#quizAddData').trigger("reset");
                                    location.reload();
                                }
                            }
                        });
                    });

                    //viewData
                    $(document).on("click", "#quiz-edit-btn", function() {
                        var quiz_id = $(this).data("id");
                        $.ajax({
                            url: "admin/viewQuiz",
                            type: 'POST',
                            data: {
                                quiz_id: quiz_id,
                            },
                            success: function(data) {
                                var response = JSON.parse(data); //decode
                                $("#e_quiz_id").val(response.quiz_id);
                                $("#e_title").val(response.title);
                                $("#e_description").val(response.description);
                                $("#e_time_limit").val(response.time_limit);
                            }
                        });
                    });

                    // editData
                    $("#editQuizData").on('submit', function(e) {
                        e.preventDefault();
                        $.ajax({
                            type: 'POST',
                            url: 'admin/editQuiz',
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
                                    // $("#editQuizModal").modal('hide');
                                    // quizDisplay();
                                    location.reload();
                                }
                            }
                        });
                    });

                    //deleteData
                    $(document).on("click", "#quiz-delete-btn", function() {
                        var id = $(this).data("id");
                        var id = $('#delete_id').val(id);
                    });
                });

                function deleteQuiz() {
                    var quiz_id = $('#delete_id').val();
                    // alert(quiz_id);
                    $('#deleteQuizModal').modal('hide');
                    $.ajax({
                        url: "admin/deleteQuiz",
                        type: 'post',
                        data: {
                            quiz_id: quiz_id
                        },
                        success: function(data) {
                            var response = JSON.parse(data);
                            alert(response.message);
                            // quizDisplay();
                            location.reload();
                        }
                    });
                }

                function quizDisplay() {
                    $.ajax({
                        url: "admin/displayQuizzes",
                        type: "post",
                        success: function(data) {
                            $("#quizData").html(data);
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