<?php
require 'functions.php';
$title = "profile";

check_login();

// <!-- default profile pic checker -->

$user_pic = $_SESSION['info']['image'];
$default_pic = "uploads/default.png";
if (file_exists($_SESSION['info']['image'])) {
    $profile_pic = $user_pic;
} else {
    $profile_pic = $default_pic;
}

// delete a profile from db
if ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && $_POST['action'] == 'delete') {

    $id = $_SESSION['info']['id'];
    $query = "delete from profile where id = '$id' limit 1";
    $result = mysqli_query($con, $query);

    if (file_exists($_SESSION['info']['image'])) {
        unlink($_SESSION['info']['image']);
    }
    $query = "delete from post where user_id ='$id'";
    $result = mysqli_query($con, $query);
    header("Location:logout.php");
    die;
}



// <!--  edit profile and save into db -->               
elseif ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['username'])) {

    $image_upload = false;

    if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] == 0) {
        // file uploaded succesfully by checking name key in image array
        $folder = "uploads/";
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }
        $destination = $folder.$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $destination);

        if (file_exists($_SESSION['info']['image'])) {
            unlink($_SESSION['info']['image']);
        }

        $image_upload = true;

    }

    $username = addslashes($_POST['username']);
    $email = addslashes($_POST['email']);
    $password = addslashes($_POST['password']);
    $id = $_SESSION['info']['id'];

    // update query
    if ($image_upload == true) {
        $query = "update profile set username = '$username', email = '$email' , password = '$password',image = '$destination' where id = '$id' limit 1 ";
    } else {
        $query = "update profile set username = '$username', email = '$email' , password = '$password' where id = '$id' limit 1 ";
    }

    $result = mysqli_query($con, $query);
    // to update session
    $query = "select * from profile where id = '$id' limit 1";

    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['info'] = mysqli_fetch_assoc($result);
    }
    header("location: profile.php");
    die;
}
// insert query for about
elseif($_SERVER['REQUEST_METHOD']== 'POST' && !empty($_POST['about-check'])){
    // var_dump($_POST);   
$id= $_SESSION['info']['id'];
$job = $_POST['job'];
$location= $_POST['location'];
$hobby = $_POST['hobby'];
$query = "insert into about (user_id , job , location , hobby) values( '$id','$job','$location','$hobby')";
$result = mysqli_query($con,$query);
header("location:profile.php");
die;
}
// edit query for about


elseif ($_SERVER['REQUEST_METHOD']== 'POST' && !empty($_POST['about-edit'])){
$job = $_POST['job'];
$location = $_POST['location'];
$hobby = $_POST['hobby'];
$id =$_SESSION['info']['id'];
$query = "update about set job ='$job', location='$location', hobby='$hobby' where user_id ='$id'";
$result = mysqli_query($con,$query);
header("location:profile.php");
die;
   
}
else{  
    //    read query
     $id= $_SESSION['info']['id'];
     $query = "select * from about where user_id = '$id' limit 1";
     $result = mysqli_query($con, $query);
     $row = mysqli_fetch_assoc($result); 
    
}

?>
<?php
include 'partials/header.php';
?>

<section class="h-100 gradient-custom-2">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-lg-9 col-xl-7">
                <!-- if clicked on edit profile -->
                <?php if (!empty($_GET['action']) && $_GET['action'] == 'edit'): ?>


                    <div class="container bootstrap snippets bootdey">
                        <h1 class="text-primary">Edit Profile</h1>
                        <hr>
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-3">
                                <div class="text-center">
                                    <div>
                                        <img src="<?php echo $profile_pic ?>" class=" img-circle img-thumbnail "
                                            style="width:170px;height:175px;" alt="user-image">
                                    </div>
                                    <h6 style="padding-top:10px">Upload a different photo...</h6>


                                </div>
                            </div>

                            <!-- edit form column -->
                            <div class="col-md-9 personal-info">
                                <h3>Personal info</h3>

                                <form method="post" class="form-horizontal" id="edit-profile" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">User Name:</label>
                                        <div class="col-lg-8">
                                            <input value="<?php echo $_SESSION['info']['username'] ?>" class="form-control"
                                                name="username" type="text" placeholder="username" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Email:</label>
                                        <div class="col-lg-8">
                                            <input value="<?php echo $_SESSION['info']['email'] ?>" class="form-control"
                                                name="email" type="text" placeholder="email" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Password:</label>
                                        <div class="col-lg-8">
                                            <input value="<?php echo $_SESSION['info']['password'] ?>" class="form-control"
                                                name="password" type="password" placeholder="password" required>
                                        </div>
                                    </div>
                                    <input type="file" name="image" class="form-control">
                                    <div class="submit-button" style=" padding: 20px 0px;">
                                        <a href="profile.php"><button type="button"
                                                class="btn btn-secondary">Cancel</button></a>
                                        <button type="submit" id="submit" name="submit"
                                            class="btn btn-primary">Update</button>
                                    </div>


                                </form>
                            </div>
                        </div>
                    </div>

                    <!--  delete a profile -->
                <?php elseif (!empty($_GET['action']) && $_GET['action'] == 'delete'): ?>
                    <div class="container bootstrap snippets bootdey">

                        <h1 class="text-primary">Are you sure want to delete the profile &#63;
                        </h1>
                        <hr>
                        <div class="row">

                            <form method="post" class="form-horizontal" id="delete-profile">

                                <div class="col-md-3">
                                    <div class="text-center">
                                        <div style="width:166px;height:200px;">
                                            <img src="<?php echo $profile_pic ?>" class="img-circle img-thumbnail "
                                                style="width:170px;height:180px;" alt="user-image">
                                        </div>



                                    </div>
                                </div>

                                <div class="col-md-9 personal-info">
                                    <div><label>Name:&nbsp;</label>
                                        <?php echo $_SESSION['info']['username'] ?>
                                    </div>
                                    <div> <label>Email:&nbsp;&nbsp;</label>
                                        <?php echo $_SESSION['info']['email'] ?>
                                    </div>
                                    <input type="hidden" name="action" value="delete">
                                    <hr>

                                    <div class="submit-button" style=" padding: 20px 0px;">
                                        <a href="profile.php"><button type="button"
                                                class="btn btn-secondary">Cancel</button></a>
                                        <button type="submit" name="delete" class="btn btn-primary">Delete</button>
                                    </div>

                                </div>

                            </form>
                        </div>
                    </div>


                <?php else: ?>

                    <div class="card">
                        <div class="rounded-top text-white d-flex flex-row" style="background-color: #000; height:200px;">
                            <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;height: 245px;">
                                <img src="<?php echo $profile_pic ?>" alt="Generic placeholder image"
                                    class="img-fluid img-thumbnail mt-4 mb-2"
                                    style="width: 150px; height:170px ;z-index: 1">
                                <div class="user-control">
                                    <a href="profile.php?action=edit" ;>
                                        <button class="btn btn-outline-dark" data-mdb-ripple-color="dark" ;>
                                            Edit profile
                                        </button>
                                    </a>
                                    <a href="profile.php?action=delete" ;>
                                        <button class="btn btn-outline-dark" data-mdb-ripple-color="dark" ;>
                                            Delete Profile
                                        </button>
                                    </a>
                                </div>
                            </div>

                            <div class="ms-3" style="margin-top: 130px;">
                                <h5>
                                    <?php echo $_SESSION['info']['username']; ?>
                                </h5>
                                <p>
                                    <?php echo $_SESSION['info']['email']; ?>
                                </p>
                            </div>
                        </div>
                        <div class="py-5 text-black" style="background-color: #f8f9fa; ">
                        </div>
                        <div class="card-body p-4 text-black">
                       
                         <?php if(empty($row)):?>
                            <div class="mb-5">
                                <p class="lead fw-normal mb-1">Update Your Info <i class="fa-regular fa-circle-question"></i></p>
                                <div class="p-4" style="background-color: #f8f9fa;">
                                <form method="POST">  
                                     <input class="form-control about" name="job" placeholder="Career">
                                    <input class="form-control about" name="location" placeholder="Location">
                                    <input class="form-control about" name="hobby" placeholder="Hobbies">
                                    <input  type="hidden" name="about-check" value="about">
                                    <button type="submit" class="btn btn-primary" style="margin-top:10px">ADD</button>
                         </form>
                                </div>
                            </div>
                            <?php elseif($_SERVER['REQUEST_METHOD']== 'GET' && !empty($_GET['about'])):?>
                                <div class="mb-5">
                                <p class="lead fw-normal mb-1">Edit Your Info <i class="fa-regular fa-circle-question"></i></p>
                                <div class="p-4" style="background-color: #f8f9fa;">
                                <form method="POST">  
                                     <input class="form-control about" name="job" placeholder="Career" required>
                                    <input class="form-control about" name="location" placeholder="Location" required>
                                    <input class="form-control about" name="hobby" placeholder="Hobbies"required>
                                    <input  type="hidden" name="about-edit" value="check">
                                    <button type="submit" class="btn btn-primary" style="margin-top:10px">SAVE</button>
                         </form>
                         </div>
                            </div>


                            <?php else:?>
                                <div class="mb-5">
                                <p class="lead fw-normal mb-1">About</p>
                                <div class="p-4" style="background-color: #f8f9fa;">
                                    <p class="font-italic mb-1"><i class="fa-solid fa-user-tie"></i><?=" ".$row['job']?></p>
                                    <p class="font-italic mb-1"><i class="fa-solid fa-location-dot"></i><?=" "."Lives in ".$row['location']?></p>
                                    <p class="font-italic mb-0"><i class="fa-sharp fa-solid fa-palette"></i><?=" ".$row['hobby']?></p>
                                    <a href="profile.php?about=edit"><button  type="submit" class="btn btn-primary" style="margin-top:10px" >EDIT</button></a>
                                </div>
                            </div>
                            <?php endif;?>
                            <div class="d-flex justify-content-around">
                                <button type="button" class="btn btn-secondary"><a href="#">Your Posts</a></button>
                                <button type="button" class="btn btn-info"><a href="post.php">Create Post<i
                                            class="fa-regular fa-square-plus"></i></a></button>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <p class="lead fw-normal mb-0">Recent Posts</p>
                                <p class="mb-0"><a href="#!" class="text-muted">Show all</a></p>
                            </div>
                            <!-- recent post display -->

                            <?php
                            $id = $_SESSION['info']['id'];
                            $query = "select * from post where user_id = '$id'";

                            $result = mysqli_query($con, $query);
                            ?>
                    
                                  <div class="row">

                                       <?php if (mysqli_num_rows($result) > 0): ?>
                                        <?php while ($row = mysqli_fetch_assoc($result)): ?>

                                            <?php
                                            $user_id = $row['user_id'];
                                            $query = "select username , image from profile where id ='$user_id' limit 1";
                                            $result2 = mysqli_query($con, $query);
                                            $user_row = mysqli_fetch_assoc($result2);

                                            //  <!-- profile pic checker -->
                                            $user_pic = $user_row['image'];
                                            $default_pic = "uploads/default.png";
                                            if (file_exists($user_row['image'])) {
                                                $profile_pic = $user_pic;
                                            } else {
                                                $profile_pic = $default_pic;
                                            }
                                            ?>

                                            <!-- Trending Top -->
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="post-box mb-30">
                                                    <div class="post-image">
                                                        <?php if (file_exists($row['image'])): ?>
                                                            <div id="published_img">
                                                            <img src="<?php echo $row['image'] ?>" alt="">
                                                            <a href="post.php?action=post_delete&id=<?=$row['id']?>"><button type="button" class="btn btn1" ><i class="fa-solid fa-trash-can"></i></button></a>
                                  <a href="post.php?action=post_edit&id=<?=$row['id']?>"><button type="button" class="btn btn2"><i class="fa-solid fa-file-pen"></i></button></a>
                                                        </div>
                                                        <?php endif; ?>
                                                        <div class="post-box-text">
                                                            <span class="bgb"><?php echo $row['category'] ?></span>
                                                            <h2><a href="#">
                                                                    <?php echo "<b>" .substr($row['title'],0,30). "</b>"; ?>
                                                                </a></h2>
                                                            <p>by
                                                                <?php echo $user_row['username'] ?> -
                                                                <?php echo date('F j, Y g:i A', strtotime($row['date'])); ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endwhile; 
                                        endif;?>
                                   </div>
                          
                        </div>
                <?php endif ?>
            </div>
        </div>
    </div>
    </div>
    </div>
</section>
<?php

include 'partials/footer.php';
?>