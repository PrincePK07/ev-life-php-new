<?php
require '../functions.php';
require 'partials/header.php';
check_login();

$id= $_GET['id'];
$status = $_GET['status'];

$query ="update profile set status = '$status' where id= '$id'";
$result = mysqli_query($con,$query);
header('location:admin.php');
require 'partials/footer.php';
?>