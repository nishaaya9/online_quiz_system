<?php
include "checkSession.php";
include "header.php";
include "navbar.php";
include "sidebar.php";
include "../connection.php";
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- right column -->
                <div>
                    <!-- general form elements disabled -->
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Quiz Report</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
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
                                                            <th>S.No</th>
                                                            <th>Quizzes</th>
                                                            <th>Completed</th>
                                                            <th>In Progress</th>
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
                                    quizReport();
                                });

                                function quizReport() {
                                    $.ajax({
                                        url: "admin/quizReportData",
                                        type: "get",
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
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<?php
include "footer.php";
?>