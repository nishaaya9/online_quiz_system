<?php
include "session-check.php";
include "header.php";
include "navbar.php";
include "sidebar.php";
include "connection.php";
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">My Quiz List</h3>
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
                                                <th>S.No</th>
                                                <th>Quizzes</th>
                                                <th>Time Limit</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="quizzesList">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<!-- jquery/ajax code -->
<script>
    //displayData
    $(document).ready(function() {
        quizzesListDisplay();
        var quizCompleted = false;
    });

    function quizzesListDisplay() {
        $.ajax({
            url: "displayQuizzesList",
            type: "get",
            success: function(data) {
                $("#quizzesList").html(data);
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

<?php
include "footer.php";
?>