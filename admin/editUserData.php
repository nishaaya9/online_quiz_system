<?php
include "../connection.php";

$id = $_POST["e_id"];
$name = mysqli_real_escape_string($conn, $_POST["e_name"]);
$email = mysqli_real_escape_string($conn, $_POST["e_email"]);
$contact = $_POST['e_contact'];
$gender = $_POST['e_gender'];
$city = $_POST["e_city"];
$designation = $_POST['e_designation'];

// Check if a file is uploaded
if ($_FILES['e_file']['name'] != "") {
    $filename = $_FILES['e_file']['name'];
    move_uploaded_file($_FILES['e_file']['tmp_name'], "images/" . $filename);
    // Update with the new file
    $q = "UPDATE `users` SET `image`='$filename', `name` = '$name', `email` = '$email', `contact` = '$contact', `g_id`='$gender', `c_id` = '$city',`d_id`='$designation' WHERE `users`.`id` = $id";
} else {
    // No file uploaded, keep the existing file
    $q = "UPDATE `users` SET `name` = '$name', `email` = '$email', `contact` = '$contact', `g_id`='$gender', `c_id` = '$city',`d_id`='$designation' WHERE `users`.`id` = $id";
}

if (mysqli_query($conn, $q)) {
    $response = [
        'status' => 'ok',
        'success' => true,
        'message' => 'Record updated successfully!'
    ];
    echo json_encode($response);
} else {
    $response = [
        'status' => 'ok',
        'success' => false,
        'message' => 'Record update failed!'
    ];
    echo json_encode($response);
}
?>





// include "../connection.php";

// // image
// $image_name = $_POST["image_name"];
// if ($_FILES['e_file']['name'] != "") {
//     $filename = $_FILES['e_file']['name'];
//     move_uploaded_file($_FILES['e_file']['tmp_name'], "../images/" . $filename);
//     if (file_exists("../images/" . $image_name)) {
//         unlink("../images/" . $image_name);
//     }
// } else {
//     echo "plz select a file";
// }

// $id = $_POST["e_id"];
// $name = mysqli_real_escape_string($conn, $_POST["e_name"]);
// $email = mysqli_real_escape_string($conn, $_POST["e_email"]);
// $contact = $_POST['e_contact'];
// $gender = $_POST['e_gender'];
// $city = $_POST["e_city"];
// $designation = $_POST['e_designation'];

// $q = "UPDATE `users` SET `image`='$filename', `name` = '$name', `email` = '$email', `contact` = '$contact', `g_id`='$gender', `c_id` = '$city',`d_id`='$designation' WHERE `users`.`id` = $id";
// if (mysqli_query($conn, $q)) {
//     $response = [
//         'status' => 'ok',
//         'success' => true,
//         'message' => 'Record updated succesfully!'
//     ];
//     echo json_encode($response);
// } else {
//     $response = [
//         'status' => 'ok',
//         'success' => false,
//         'message' => 'Record updated failed!'
//     ];
//     echo json_encode($response);
// }
