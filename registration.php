  <?php
  require "functions.php";
  $title = "registration";
  $user = 0;



  if($_SERVER["REQUEST_METHOD"] == "POST"){

  $username = addslashes($_POST['username']);
  $email   = addslashes($_POST['email']);
  $query = "SELECT * FROM  profile where username='$username' OR email='$email'";
  $result1 = mysqli_query($con , $query);
  if($result1){
    $num = mysqli_num_rows($result1);
    if($num>0){
      $user=1;
  }else{

  $username = ucwords(addslashes($_POST['username']));
  $number = addslashes($_POST['number']);
  $password = addslashes($_POST['password']);
  $email = addslashes($_POST['email']);
  $date = date('Y-m-d H:m:s');
  $comments =addslashes($_POST['comments']);

  $query = "insert into profile( username,number, email, password, date, comments) value('$username','$number','$email','$password','$date','$comments' )";
  $result = mysqli_query($con ,$query);
  $user=2;
  header("location: login.php");
  die;
  }
  }
  }
?>

    <?php
    include "partials/header.php";
    ?>
    <?php
    if($user){
      echo '<div class= "alert alert-danger"> Username or Email Already Exists! Please sign in using existing account </div>';
    }
      ?>

    <div class="signupOnly ">
  
  <div class="container register-form ">
    <div class="form">
      <div class="note">
        <h1 style="padding-top: 2rem;">Create an account here!</h1>
      </div>
      <form id="masterForm" method="post">
        <div class="form-content">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" class="form-control" id="first-name" name="username" placeholder="Your Name *" />
              </div>
              <span class="form-error" id="first-error"></span>
              <div class="form-group">
                <input type="text" class="form-control" id="phoneNumber" name="number" placeholder="Phone Number *" />
              </div>
              <span class="form-error" id="phone-error"></span>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" class="form-control" id="password1" name="password" placeholder="Your Password *" />
              </div>
              <span class="form-error" id="password-error1"></span>
              <div class="form-group">
                <input type="text" class="form-control" id="password2" placeholder="Confirm Password *" />
              </div>
              <span class="form-error" id="password-error2"></span>
            </div>
          </div>
          <div class="row align-items-center mt-4">
            <div class="col">
              <input type="text" class="form-control" id="email1" name="email" placeholder=" Enter Email Address" />
            </div>
            <span class="form-error" id="email-error"></span>
          </div>
          <div class="row align-items-center mt-4">
            <div class="col">
              <input type="text" class="form-control" id="comments" name="comments" placeholder=" Any comments / optional" />
            </div>
            <span class="form-error" id="comment-error"></span>
          </div>
          <div class="row justify-content-start mt-4">
            <div class="col">
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" />
                  I hereby agree to the <a href="/"> Terms and Conditions. </a>
                </label>
              </div>
              <button type="submit" class="btnSubmit">Submit</button>
            </div>
          </div>
        </div>
      </form>
      </div> 
    </div> 
  
    
    



  <?php
  include 'partials/footer.php';
  ?>