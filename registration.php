<?php
include "connection.php";
$name = "";
$email = "";
$namemsg = "";
$emailmsg = "";
$cpassmsg = "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration Page</title>
    <style>
        .errorColor {
            color: red;
        }

        .error span {
            color: red;
        }

        span.error {
            color: red;
        }
    </style>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <script src="js/jquery.js"></script>
</head>

<body class="hold-transition register-page">
    <div class="register-box" style="width: 670px;">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h1><b>Registration Form</b></h1>
            </div>
            <div class="card-body">
                <form method="post" id="addData" class="row g-3" enctype="multipart/form-data">
                    <div class="mb-3 col-md-6">
                        <label for="role" class="form-label">Role</label>
                        <select name="r_id" id="role" class="form-control">
                            <option selected disabled>Select role</option>
                            <option value="1">Admin</option>
                            <option value="2">User</option>
                        </select>
                        <span class="error" id="role_err"> </span>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="file" class="form-label">Image</label>
                        <input type="file" class="form-control" id="file" name="file">
                        <span class="error" id="file_err"> </span>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name" autocomplete="on">
                        <span class="error" id="name_err"> </span>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" autocomplete="on">
                        <span class="error" id="email_err"> </span>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="contact" class="form-label">Contact</label>
                        <input type="contact" class="form-control" id="contact" aria-describedby="emailHelp" name="contact">
                        <span class="error" id="contact_err"> </span>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="gender" class="form-label">Gender</label>
                        <select name="gender" id="gender" class="form-control">
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
                        <span class="error" id="gender_err"> </span>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" autocomplete="on">
                        <span class="error" id="password_err"> </span>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="cpassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="cpassword" name="cpassword" autocomplete="on">
                        <span class="error" id="cpassword_err"> </span>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="city" class="form-label">City</label>
                        <select name="city" id="city" class="form-control">
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
                        <span class="error" id="city_err"> </span>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="designation" class="form-label">Designation</label>
                        <select name="designation" id="designation" class="form-control">
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
                        <span class="error" id="designation_err"> </span>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Register</button>
                        <a href="login">already registred?</a>
                    </div>
                </form>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->
    <script>
        $(document).ready(function(e) {
            $('#name').on('input', function() {
                checkUser();
            });

            $('#email').on('input', function() {
                checkEmail();
            });

            $('#contact').on('input', function() {
                checkContact();
            });

            $("#password").on('input', function() {
                checkPassword();
            });

            $("#cpassword").on('input', function() {
                ConfirmPassword();
            });
            $("#file").on("change", function() {

                /* current this object refer to input element */
                var $input = $(this);

                /* collect list of files choosen */
                var files = $input[0].files;

                var filename = files[0].name;

                /* getting file extenstion eg- .jpg,.png, etc */
                var extension = filename.substr(filename.lastIndexOf("."));

                /* define allowed file types */
                var allowedExtensionsRegx = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

                /* testing extension with regular expression */
                var isAllowed = allowedExtensionsRegx.test(extension);

                if (isAllowed) {
                    // alert("File type is valid for the upload");
                    /* file upload logic goes here... */
                } else {
                    alert("Invalid File Type.");
                    return false;
                }
                var fileSize = files[0].size;

                /* 1024 = 1MB */
                var size = Math.round((fileSize / 1024));

                /* checking for less than or equals to 2MB file size */
                if (size <= 2 * 1024) {
                    // alert("Valid file size");
                    /* file uploading code goes here... */
                } else {
                    alert("Invalid file size, please select a file less than or equal to 2mb size");
                }
            });

            $("#addData").on('submit', function(e) {
                e.preventDefault();

                var isValid = true;

                var selectedRole = $("#role").val();
                if (selectedRole === null || selectedRole === "" || selectedRole === "Select Role") {
                    $('#role_err').html('Please select a Role');
                    isValid = false;
                } else {
                    $('#role_err').html('');
                }

                if ($("#file").val() === '') {
                    $('#file_err').html('Please choose a file');
                    isValid = false;
                } else {
                    $('#file_err').html('');
                }

                if ($("#name").val() === '') {
                    $('#name_err').html('Please enter a name');
                    isValid = false;
                } else {
                    $('#name_err').html('');
                }

                if ($("#email").val() === '') {
                    $('#email_err').html('Please enter an email');
                    isValid = false;
                } else {
                    $('#email_err').html('');
                }

                if ($("#contact").val() === '') {
                    $('#contact_err').html('Please enter a phone number');
                    isValid = false;
                } else {
                    $('#contact_err').html('');
                }

                var selectedGender = $("#gender").val();
                if (selectedGender === null || selectedGender === "" || selectedGender === "Select Gender") {
                    $('#gender_err').html('Please select a gender');
                    isValid = false;
                } else {
                    $('#gender_err').html('');
                }

                if ($("#password").val() === '') {
                    $('#password_err').html('Please enter a password');
                    isValid = false;
                } else {
                    $('#password_err').html('');
                }

                if ($("#cpassword").val() === '') {
                    $('#cpassword_err').html('Please enter a confirm password');
                    isValid = false;
                } else {
                    $('#cpassword_err').html('');
                }

                var selectedCity = $("#city").val();
                if (selectedCity === null || selectedCity === "" || selectedCity === "Select City") {
                    $('#city_err').html('Please select a city');
                    isValid = false;
                } else {
                    $('#city_err').html('');
                }

                var selectedDesignation = $("#designation").val();
                if (selectedDesignation === null || selectedDesignation === "" || selectedDesignation === "Select Designation") {
                    $('#designation_err').html('Please select a designation');
                    isValid = false;
                } else {
                    $('#designation_err').html('');
                }

                if (isValid) {
                    $.ajax({
                        type: 'POST',
                        url: 'addData',
                        data: new FormData(this),
                        dataType: 'json',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            var response = JSON.parse(JSON.stringify(data));
                            if (response.success) {
                                alert(response.message);
                                window.location = 'login';
                            } else {
                                alert(response.message);
                            }
                        }
                    });
                }
            });
        });

        function checkUser() {
            var pattern = /^[A-Za-z0-9]+$/;
            var user = $('#name').val();
            var validuser = pattern.test(user);

            if (user === '') {
                $('#name_err').html('Please enter a name'); // Display error for empty input
                return false;
            } else if ($('#name').val().length < 3) {
                $('#name_err').html('Username length is too short');
                return false;
            } else if (!validuser) {
                $('#name_err').html('Username should be A-Z, a-z, 0-9 only');
                return false;
            } else {
                $('#name_err').html('');
                return true;
            }
        }

        function checkEmail() {
            var pattern = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            var email = $('#email').val().trim(); // Trim whitespace from email input
            var validEmail = pattern.test(email);

            if (email === '') {
                $('#email_err').html('Please enter an email address');
                return false;
            } else if (!validEmail) {
                $('#email_err').html('Invalid email address');
                return false;
            } else {
                $('#email_err').html('');
                return true;
            }
        }

        function checkContact() {
            var pattern = /^\d{10}$/;
            var contact = $('#contact').val().trim();
            var validcontact = pattern.test(contact);
            if (contact === '') {
                $('#contact_err').html('Please enter a phone number');
                return false;
            } else if (!validcontact) {
                $('#contact_err').html('Phone number must be 10 digits');
                return false;
            } else {
                $('#contact_err').html('');
                return true;
            }
        }

        // function checkPassword() {
        //     var passwordValue = $("#password").val();

        //     // Regular expressions for password complexity
        //     var hasUppercase = /[A-Z]/.test(passwordValue);
        //     var hasLowercase = /[a-z]/.test(passwordValue);
        //     var hasNumber = /\d/.test(passwordValue);
        //     var hasSpecialChar = /[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]/.test(passwordValue);

        //     if (passwordValue.length < 3 || passwordValue.length > 10) {
        //         $("#password_err").html("Length of your password must be between 3 and 10");
        //         return false;
        //     } else if (!(hasUppercase && hasLowercase && hasNumber && hasSpecialChar)) {
        //         $("#password_err").html("Password must contain uppercase, lowercase, number, and special character");
        //         return false;
        //     } else {
        //         $("#password_err").html('');
        //         return true;
        //     }
        // }

        function checkPassword() {
            var passwordValue = $("#password").val();
            if (passwordValue === '') {
                $('#password_err').html('Please enter password');
                return false;
            } else if (passwordValue.length < 3 || passwordValue.length > 10) {
                $("#password_err").html("length of your password must be between 3 and 10");
                return false;
            } else {
                $('#password_err').html('');
                return true;
            }
        }

        function ConfirmPassword() {
            let confirmPasswordValue = $("#cpassword").val();
            let passwordValue = $("#password").val();
            if (confirmPasswordValue === '') {
                $('#cpassword_err').html('Please enter confirm password');
                return false;
            } else if (passwordValue != confirmPasswordValue) {
                $("#cpassword_err").show();
                $("#cpassword_err").html("Password didn't Match");
                return false;
            } else {
                $('#cpassword_err').html('');
                return true;
            }
        }
    </script>
    <!-- jQuery -->
    <!-- <script src="plugins/jquery/jquery.min.js"></script> -->
    <!-- Bootstrap 4 -->
    <!-- <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->
    <!-- AdminLTE App -->
    <!-- <script src="dist/js/adminlte.min.js"></script> -->
</body>

</html>