<?php
include "../connection.php";

//Query
$q = "select * from users 
inner join roles on roles.r_id=users.r_id 
inner join gender on gender.g_id=users.g_id
inner join city on city.c_id=users.c_id 
inner join designation on designation.d_id=users.d_id where users.r_id='2' order by id";

$res = mysqli_query($conn, $q);
$data = "";
$i = 1;
while ($row = mysqli_fetch_assoc($res)) {
    $data .= "<tr>
        <td>$i</td>
        <td><img src='images/{$row["image"]}' height='55' width='60' ></td>
        <td>{$row['name']}</td>
        <td>{$row['email']}</td>
        <td>{$row['contact']}</td>
        <td>{$row['gender']}</td>
        <td>{$row['city']}</td>
        <td>{$row['designation']}</td>
        <td><button type='button' class='btn btn-danger' id='delete-btn' data-bs-toggle='modal' data-bs-target='#deleteDataModal' data-id='{$row["id"]}'>Delete</button></td>
        </tr>";
    $i++;
}
echo $data;
    
// <button type='button' id='edit-btn' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#editDataModal' data-id='{$row["id"]}'>Edit</button>