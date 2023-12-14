<?php
include "connection.php";

// image
if ($_FILES['file']['name'] != "") {
    $filename = $_FILES['file']['name'];
    move_uploaded_file($_FILES['file']['tmp_name'], "images/" . $filename);
} else {
    echo "<script>alert('Please Select Image')</script>";
}

$r_id = $_POST['r_id'];
$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$contact = $_POST['contact'];
$password = mysqli_real_escape_string($conn, $_POST['password']);
$cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
$gender = $_POST['gender'];
$city = $_POST['city'];
$designation = $_POST['designation'];

//namevalidation
$nameLength = strlen($name);

//checkemail
$checkemail = "select * from users where email='$email'";
$res = mysqli_query($conn, $checkemail);
$row = mysqli_fetch_array($res);

$error = "";
$response = [
    'status' => 'error',
    'success' => false
];
if (empty($r_id)) {
    $error = "Please select a role";
} elseif (empty($name)) {
    $error = "Name is required";
} elseif ($nameLength < 3) {
    $error = "username length is too short";
} elseif (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
    $error = "Only letters allowed";
} elseif (empty($email)) {
    $error = "Email is required";
} elseif (!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email)) {
    $error = "Email is not valid.";
} elseif ($row > 0) {
    $error = "Email already exist";
} elseif (empty($contact)) {
    $error = "Contact is required";
} elseif (empty($gender)) {
    $error = "Please select a gender";
} elseif (empty($password)) {
    $error = "Password is required";
} elseif (empty($cpassword)) {
    $error = "Confirm Password is required";
} elseif ($cpassword != $password) {
    $error = "Password doesn't match";
} elseif (empty($city)) {
    $error = "Please select a City";
} elseif (empty($designation)) {
    $error = "Please select a Designation";
} else {
    $q = "INSERT INTO `users` (`r_id`,`image`, `name`, `email`,`contact`, `g_id`, `password`, `c_id`, `d_id`) VALUES ('$r_id','$filename', '$name', '$email','$contact', '$gender','$password','$city','$designation')";

    if (mysqli_query($conn, $q)) {
        $response = [
            'status' => 'ok',
            'success' => true,
            'message' => 'Registered succesfully!'
        ];
        print_r(json_encode($response));
    } else {
        $response = [
            'status' => 'error',
            'success' => false,
            'message' => 'Record created failed!'
        ];
        print_r(json_encode($response));
    }
}

if (!empty($error)) {
    $response["message"] = $error;
    print_r(json_encode($response));
}
