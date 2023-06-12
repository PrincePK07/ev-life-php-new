<?php
require "functions.php";
$title = "login";




if($_SERVER["REQUEST_METHOD"] == "POST"){
  $email = addslashes($_POST['email']);
  $password = addslashes($_POST['password']);

$query = "select * from profile where email = '$email' && password = '$password' limit 1";
$result = mysqli_query($con ,$query);

if((mysqli_num_rows($result)) >0){
  $row = mysqli_fetch_assoc($result);

  if($row['user_type'] == 'user' && $row['status'] == 1){
    // storing info into sessions
 $_SESSION['info']= $row;
 header('location:profile.php');
  }
elseif($row['user_type']=='user' && $row['status']==0){
 echo '<div class ="alert alert-danger"> Your account is currently inactive . Please wait for admin approval!</div>';
}
  elseif($row['user_type'] == 'admin' ){
    $_SESSION['info']= $row;
    header('location:admin/admin.php');
  }
  
  else{
  $error = "Invalid user name or password";
}



}
}
 ?>
 <?php
  include "partials/header.php";
  ?>
  <section class="vh-100 login-page" >
  <?php

if(!empty($error)){
  echo "<div class='alert alert-danger'>".$error."</div>";
}
?>  
  <div class="container py-5 h-100 ">
    <div class="row d-flex justify-content-center align-items-center h-100 main-block ">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong login-block" >
          <div class="card-body p-5 text-center">

            <h3 class="mb-4" style=" color: white;">SIGN IN</h3>
            <hr class="my-4">
            <form method="post"  id="masterLogin">

            <div class="form-outline mb-4">
              <input type="text" id="email" name="email" class="form-control form-control-lg" placeholder="Email Address"  />
          
              
              
            </div>

            <div class="form-outline mb-4">
              <input type="password" id="password1" name="password" class="form-control form-control-lg" placeholder="Password"/>
            </div>
            <span class="form-error" id="login-error" style="color: red; display: block; margin-bottom: 22px; background-color: yellow;"></span>
            

            <button class="btn btn-primary btn-lg btn-block" type="submit" >Login</button>
            </form>     

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
  <?php
include 'partials/footer.php';
?>