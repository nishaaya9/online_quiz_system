<?php
session_start();
include "connection.php";
$msg = "";

if (isset($_REQUEST['submit'])) {
    extract($_POST);
    // $q = "select * from users where email='" . $email . "' and password='" . $password . "'";

    $q = "select * from users where email='$email' and password='$password' and r_id=2";
    $res = mysqli_query($conn, $q);

    if (mysqli_num_rows($res) > 0) {
        $_SESSION['email'] = $email;
        $row = mysqli_fetch_array($res);
        $name = $row['name'];
        $_SESSION['name'] = $name;
        $image = $row['image'];
        $_SESSION['image'] = $image;
        $id = $row['id'];
        $_SESSION['id'] = $id;
        header("location:home");
    } else {
        $q = "select * from users where email='$email' and password='$password' and r_id=1";
        $res = mysqli_query($conn, $q);

        if (mysqli_num_rows($res) > 0) {
            $_SESSION['email'] = $email;
            header("location:admin/index");
        } else {
            $msg = "<div class='alert alert-danger' align='center'>Invalid username or password</div>";
        }
    }
    if (isset($_REQUEST['chkrem'])) {
        setcookie("uname", $_REQUEST['txtuname'], time() + 60 * 60 * 24 * 30);
        setcookie("pass", $_REQUEST['txtpass'], time() + 60 * 60 * 24 * 30);
    }
}
if (isset($_COOKIE['uname']))
    $u = $_COOKIE['uname'];
else
    $u = "";
if (isset($_COOKIE['pass']))
    $p = $_COOKIE['pass'];
else
    $p = "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <base href="http://localhost/online_quiz_system/">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box" style="width: 400px; height: 450px;">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h1><b>Login</b></h1>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="container">
                        <?php echo $msg; ?>
                        <div>
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" name="email" id="email" value="<?php echo $u; ?>" placeholder="Email" autocomplete="on" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" name="password" id="password" value="<?php echo $p; ?>" placeholder="Password" autocomplete="on" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <input type="checkbox" name="chkrem"> Remember Me
                            </div>
                            <div class="mb-2">
                                <button type="submit" class="btn btn-primary btn-block" name="submit">Sign In</button>
                                <a href="registration">Sign Up</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->
</body>

</html>