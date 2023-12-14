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
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- table -->
                            <div>
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Contact</th>
                                            <th>gender</th>
                                            <th>City</th>
                                            <th>Designation</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableData">
                                    </tbody>
                                </table>
                            </div>
                           
                            <!-- editModal -->
                            <div class="modal fade" id="editDataModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form method="post" id="editData" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                <div class="form-group mb-3">
                                                    <label for="file" class="form-label">Image</label>
                                                    <img id="image_input" src="" height="55px" width="60px">
                                                    <input type="hidden" id="image_name" name="image_name">
                                                    <input type="file" class="form-control mt-1" id="file_input" name="e_file">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label>Name</label>
                                                    <input type="text" name="e_name" id="name_input" class="form-control" required>
                                                    <!-- <span class="error" id="e_name_err"> </span> -->
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label>Email</label>
                                                    <input type="email" name="e_email" id="email_input" class="form-control" required>
                                                    <!-- <span class="error" id="e_email_err"> </span> -->
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label>Contact</label>
                                                    <input type="contact" name="e_contact" id="contact_input" class="form-control" required>
                                                    <!-- <span class="error" id="e_contact_err"> </span> -->
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="exampleInputPassword1" class="form-label">Gender</label>
                                                    <select name="e_gender" id="gender_input" class="form-control">
                                                        <option selected disabled>Select Gender</option>
                                                        <?php
                                                        $q = "select * from gender";
                                                        $res = mysqli_query($conn, $q);
                                                        while ($row = mysqli_fetch_assoc($res)) {
                                                        ?>
                                                            <option value="<?= $row["g_id"] ?>"><?= $row["gender"]; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputPassword1" class="form-label">City</label>
                                                    <select name="e_city" id="city_input" class="form-control">
                                                        <option selected disabled>Select City</option>
                                                        <?php
                                                        $q = "select * from city order by city";
                                                        $res = mysqli_query($conn, $q);
                                                        while ($row = mysqli_fetch_assoc($res)) {
                                                        ?>
                                                            <option value="<?= $row["c_id"] ?>"><?= $row["city"]; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <!-- <span class="error" id="city_err"> </span> -->
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputPassword1" class="form-label">Designation</label>
                                                    <select name="e_designation" id="designation_input" class="form-control">
                                                        <option selected disabled>Select Designation</option>
                                                        <?php
                                                        $q = "select * from designation";
                                                        $res = mysqli_query($conn, $q);
                                                        while ($row = mysqli_fetch_assoc($res)) {
                                                        ?>
                                                            <option value="<?= $row["d_id"] ?>"><?= $row["designation"]; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <input type="hidden" name="e_id" id="id_input" class="form-control">
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
                            <div class=" modal fade" id="deleteDataModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                            <button type="button" class="btn btn-danger" onclick="deleteData()">Yes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                //displayData
                                $(document).ready(function() {
                                    userDisplay();
                                    //     //nextButton
                                    //     var table = $('.table');
                                    //     var tbody = table.find('tbody');
                                    //     var rows = tbody.find('tr');
                                    //     // alert(rows.length);
                                    //     var rowsPerPage = 2;
                                    //     var currentPage = 1;

                                    //     function showRows() {
                                    //         var startIndex = (currentPage - 1) * rowsPerPage;
                                    //         var endIndex = startIndex + rowsPerPage;

                                    //         rows.hide();
                                    //         rows.slice(startIndex, endIndex).show();
                                    //     }

                                    //     showRows();

                                    //     $("#nextButton").click(function(e) {
                                    //         e.preventDefault();
                                    //         if (currentPage < Math.ceil(rows.length / rowsPerPage)) {
                                    //             currentPage++;
                                    //             showRows();
                                    //         }
                                    //     });
                                });

                                function userDisplay() {
                                    $.ajax({
                                        url: "admin/displayUsers",
                                        type: "post",
                                        success: function(data) {
                                            // console.log(data);
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

                                //viewData
                                $(document).on("click", "#edit-btn", function() {
                                    var id = $(this).data("id");
                                    $.ajax({
                                        url: "admin/viewUser",
                                        type: 'POST',
                                        data: {
                                            id: id,
                                        },
                                        success: function(data) {
                                            var response = JSON.parse(data); //decode
                                            $("#id_input").val(response.id);
                                            $("#image_name").val(response.image);
                                            var i = "images/" + response.image;
                                            $("#image_input").attr("src", i);
                                            $("#name_input").val(response.name);
                                            $("#email_input").val(response.email);
                                            $("#contact_input").val(response.contact);
                                            $("#gender_input").val(response.g_id);
                                            $("#city_input").val(response.c_id);
                                            $("#designation_input").val(response.d_id);
                                        }
                                    });
                                });

                                // editData
                                $(document).ready(function(e) {
                                    $("#editData").on('submit', function(e) {
                                        e.preventDefault();
                                        $.ajax({
                                            type: 'POST',
                                            url: 'admin/editUserData',
                                            data: new FormData(this),
                                            dataType: 'json',
                                            contentType: false,
                                            cache: false,
                                            processData: false,
                                            success: function(data) {
                                                var response = JSON.parse(JSON.stringify(data));
                                                // console.log(response);
                                                if (response.success) {
                                                    alert(response.message);
                                                    $("#editDataModal").modal('hide');
                                                    userDisplay();
                                                } else {
                                                    alert(response.message);
                                                }
                                            }
                                        });
                                    });
                                });

                                //deleteData
                                $(document).on("click", "#delete-btn", function() {
                                    var id = $(this).data("id");
                                    var id = $('#delete_id').val(id);
                                });

                                function deleteData() {
                                    var id = $('#delete_id').val();
                                    // alert(id);
                                    $('#deleteDataModal').modal('hide');
                                    $.ajax({
                                        url: "admin/deleteUser",
                                        type: 'post',
                                        data: {
                                            id: id
                                        },
                                        success: function(data) {
                                            var response = JSON.parse(data);
                                            alert(response.message);
                                            // userDisplay();
                                            location.reload();
                                        }
                                    });
                                }
                            </script>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<?php
include "footer.php";
?>