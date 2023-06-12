<?php
require '../functions.php';
require 'partials/header.php';
check_login();
$post_id = $_GET['id'];
$status = $_GET['status'];

$query = "update post set status = '$status' where id = '$post_id'";
$result = mysqli_query($con,$query);

$query = " select user_id from post where id = '$post_id'";
$result = mysqli_query($con,$query);
if(mysqli_num_rows($result)>0){
$row = mysqli_fetch_assoc($result);
header("location:admin.php?action=view_post&id=".$row['user_id']);
}
require 'partials/footer.php';

?>