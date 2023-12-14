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

            <!-- btn -->
            <div class="col-md-12 mt-2" style="float:left">
                <div>
                    <button type='button' id="assignQuizBtn" class='btn btn-primary mt-2' data-bs-toggle='modal' data-bs-target='#assignQuizzesToUsersModal'>Assign Quizzes To Users</button>
                </div>
            </div>

            <!-- addmodal -->
            <div class="modal fade" id="assignQuizzesToUsersModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Assign Quizzes to Users</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" id='myForm'>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Users</label>
                                    <br>
                                    <select name="user_id[]" id="name" class="form-control select2" multiple="multiple" data-placeholder="Select Users" required>
                                        <?php
                                        $q = "select * from users where r_id='2'";
                                        $res = mysqli_query($conn, $q);
                                        if (mysqli_num_rows($res) > 0) {
                                            foreach ($res as $value) {
                                        ?>
                                                <option value="<?= $value['id'] ?>"><?= $value['name']; ?></option>
                                        <?php
                                            }
                                        } else {
                                            echo "No record found";
                                        } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Quizzes</label>
                                    <br>
                                    <select name="quiz_id[]" id="quiz_title" class="form-control select2" multiple="multiple" data-placeholder="Select Quiz Title" required>
                                        <?php
                                        $q = "select * from quizzes";
                                        $res = mysqli_query($conn, $q);
                                        if (mysqli_num_rows($res) > 0) {
                                            foreach ($res as $value) {
                                        ?>
                                                <option value="<?= $value['quiz_id'] ?>"><?= $value['title']; ?></option>
                                        <?php
                                            }
                                        } else {
                                            echo "No record found";
                                        } ?>
                                    </select>
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

            <!-- displayData -->
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
                                            <th>Users</th>
                                            <th>Quizzes</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableData">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- deleteModal -->
            <div class=" modal fade" id="deleteAssignQuizzesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <button type="button" class="btn btn-danger" onclick="deleteAssignQuizzes()">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- jquery/ajax code -->
    <script>
        //displayData
        $(document).ready(function() {
            assignQuizzesToUsers();

            //addData
            $("#myForm").on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'post',
                    url: 'admin/assignQuizToUser',
                    data: new FormData(this), //$(this).serializeArray(),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        var response = JSON.parse(JSON.stringify(data));
                        if (response) {
                            alert(response.message);
                            // $("#assignQuizzesToUsersModal").modal('hide');
                            // assignQuizzesToUsers();
                            location.reload();
                        }
                    }
                });
            });
        });

        function assignQuizzesToUsers() {
            $.ajax({
                url: "admin/assignQuizzesToUsers",
                type: "post",
                success: function(data) {
                    $("#tableData").html(data);
                    $("#example1").DataTable({
                        "paging": true,
                        "lengthChange": true,
                        "searching": true,
                        "bDestroy": true
                    });
                }
            });
        }

        //deleteData
        $(document).on("click", "#delete-btn", function() {
            var id = $(this).data("id");
            var id = $('#delete_id').val(id);
        });

        function deleteAssignQuizzes() {
            var user_quiz_assignments_id = $('#delete_id').val();
            // alert(user_quiz_assignments_id);
            $('#deleteAssignQuizzesModal').modal('hide');
            $.ajax({
                url: "admin/deleteAssignQuiz",
                type: 'post',
                data: {
                    user_quiz_assignments_id: user_quiz_assignments_id
                },
                dataType: 'json',
                success: function(data) {
                    var response = JSON.parse(JSON.stringify(data));
                    alert(response.message);
                    // assignQuizzesToUsers();
                    location.reload();
                }
            });
        }
    </script>
</div>
<!-- /.content -->
<?php
include "footer.php";
?>