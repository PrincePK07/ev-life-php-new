<?php
require "functions.php";

check_login();




if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['action']) && $_POST['action'] == 'post_edit'){
// edit post db insertion
$user_id = $_SESSION['info']['id'];
$id = $_GET['id'] ?? 0;
// means when no value for id , then set it as default 0.
$post = $_POST['content'];
$title = $_POST['title'];
$category = $_POST['category'];


$image_upload = false;
if(!empty($_FILES['image']['name']) && $_FILES['image']['error'] == 0){
  $folder = "uploads/";
  if(!file_exists($folder)){
    mkdir($folder,0777,true);
  }
  
  $destination = $folder.$row['id'].$_FILES['image']['name'];
  move_uploaded_file($_FILES['image']['tmp_name'],$destination);

  $query = "select * from post where id = '$id' && user_id = '$user_id' limit 1";
				$result1 = mysqli_query($con,$query);
				if(mysqli_num_rows($result1) > 0){

					$row = mysqli_fetch_assoc($result1);
					if(file_exists($row['image'])){
						unlink($row['image']);
					}

				}

    $image_upload = true;

   }  


   if( $image_upload == true){
    $query = "update post set post = '$post', image = '$destination' , category ='$category' , title = '$title' where id = '$id' && user_id = '$user_id' limit 1 ";
}else{
    $query = "update post set post = '$post', category ='$category' , title = '$title' where id = '$id' && user_id = '$user_id' limit 1 ";
}
$result = mysqli_query($con,$query);
 
		header("Location: profile.php");
		die;
     

}
elseif($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && $_POST['action'] == 'post_delete')
	{
		//delete your post
		$id = $_GET['id'] ?? 0;
		$user_id = $_SESSION['info']['id'];

		$query = "select * from post where id = '$id' && user_id = '$user_id' limit 1";
		$result = mysqli_query($con,$query);
      if(mysqli_num_rows($result) > 0){

        $row = mysqli_fetch_assoc($result);
        if(file_exists($row['image'])){
          unlink($row['image']);
        }

      }

		$query = "delete from post where id = '$id' && user_id = '$user_id' limit 1";
		$result = mysqli_query($con,$query);

		header("Location: profile.php");
		die;

	}
elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['content'])) {

  
  // adding images into db
  $image = "";
  if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] == 0) {
    $folder = "uploads/";
    if (!file_exists($folder)) {
      mkdir($folder, 0777, true);
    }
    // if fresh image upload
    $image = $folder.$_FILES['image']['name'];

    $file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

    $i = 1;
    while (file_exists($image)) {
        // If a file with the same name exists, add an increment to the file name
        $file_name = pathinfo($_FILES['image']['name'], PATHINFO_FILENAME) . '_' . $i . '.' . $file_extension;
        $image = $folder . $file_name;
        $i++;
    }


    move_uploaded_file($_FILES['image']['tmp_name'], $image);
  }

  $post = $_POST['content'];
  $user_id = $_SESSION['info']['id'];
  $category = $_POST['category'];
  $title = $_POST['title'];
  $editor = $_SESSION['info']['username'];
  date_default_timezone_set('Asia/Kolkata');
  $date = date('Y-m-d H:m:s');

  $query = "insert into post ( user_id , post , image , date , category, title, editor)	values(' $user_id','$post','$image','$date','$category','$title','$editor')";
  $result = mysqli_query($con, $query);

  header("location:profile.php");
  die;
}

include 'partials/header.php';
?>


<section class="h-100 gradient-custom-2">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-lg-9 col-xl-7">
        <div class="card">
          <div class="rounded-top text-white d-flex flex-row post">


          </div>
          <?php if(!empty($_GET['action']) && $_GET['action'] =='post_edit' && !empty($_GET['id'])):?>
            <?php
            $id = (int)$_GET['id'];
            $query = "select * from post where id = '$id' limit 1";
            $result = mysqli_query($con,$query);

            ?>
            <?php if(mysqli_num_rows($result) > 0):?>
              <?php $row = mysqli_fetch_assoc($result);?>
            <!-- edit post content starts here -->
            <div class="p-4 text-black" style="background-color: #f8f9fa;">
            <div class="d-flex justify-content-end text-center py-1">

            </div>
          </div>
          <div class="card-body p-4 text-black">
            <form method="post" enctype="multipart/form-data">
            <div class="mb-5">
              <p class="lead fw-normal mb-1">EDIT POST<i class="fa-solid fa-pen-to-square"></i></p>
              

                <div class="p-4" id="post1">
                <div>
                <img id="Editpost_image" src="<?=$row['image']?>" >
            </div>
            <div class="form-group">
    <label for="exampleFormControlInput1">Blog Title</label>
    <input name='title' class="form-control" id="exampleFormControlInput1" value="<?=$row['title']?>">
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Categories</label>
    <select class="form-control" name="category" id="exampleFormControlSelect1" >
    <option value="" disabled>Select a category</option>
 
    <!-- category import query -->
      <?php
    
      $query = "select * from category ";
      $result = mysqli_query($con,$query);
      if(mysqli_num_rows($result)>0)
      while($row2 = mysqli_fetch_assoc($result)):?>
     <?php 
      if($row2['name'] == $row['category']){
        $selected ='selected';
      }else{
        $selected = '';
   
      }  
        echo "<option $selected>" . $row2['name'] . "</option>";
    
   
      endwhile;
      ?>

    </select>
  </div>
              <label style= "color:white;"for="exampleFormControlTextarea1">Write here</label>
              <textarea class="form-control" name="content" id="myTextarea"rows="3"> <?php echo $row['post']?></textarea>
              <input type="file" name ="image" class="form-control" style="margin-top:15px">
              <input type="hidden" name="action" value="post_edit">
              <button type="submit" class="btn btn-primary post2" >Save</button>
              <button type="button" class="btn btn-primary post2"><a href="post.php">Cancel</a></button>
                </div>
              </div>
            </div>
          </form>
          <?php endif;  ?>
<!-- delete post starts here -->
              <?php elseif(!empty($_GET['action']) && $_GET['action']=='post_delete' && !empty($_GET['id'])):?>
                <?php
                $id=$_GET['id'];
                $query = "select * from post where id = '$id' limit 1";
                $result = mysqli_query($con,$query);
                ?>
                <?php if(mysqli_num_rows($result)>0):?>
                  <?php $row = mysqli_fetch_assoc($result)?>
                  <form method="post">
                <h1 style="color:black">Are you sure want to delete this post?<i class="fa-solid fa-triangle-exclamation fa-xl" ></i></h1>
              
                <div class="submit-button delete" >
                <a href="post.php"><button type="button"
                 class="btn btn-secondary">Cancel</button></a>
                 <input type="hidden" name="action" value="post_delete">
                <a><button type="submit"
                 class="btn btn-primary">Delete</button></a>
                </div>
                </form>
                <?php endif?>

                <?php else:?>
          <div class="p-4 text-black" style="background-color: #f8f9fa;">
            <div class="d-flex justify-content-end text-center py-1">

            </div>
          </div>
          <div class="card-body p-4 text-black">
            <form method="post" enctype="multipart/form-data">
            <div class="mb-5">
              <p class="lead fw-normal mb-1">Create a post here!</p>
              <div class="p-4" id="post1">
              <div class="form-group">
    <label for="exampleFormControlInput1">Blog Title</label>
    <input name='title' class="form-control" id="exampleFormControlInput1" placeholder="Title">
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Categories</label>
    <select class="form-control" name="category" id="exampleFormControlSelect1">
    <option value="" selected disabled hidden>Select a category</option>
    <!-- category import query -->
      <?php
      $query = "select * from category ";
      $result = mysqli_query($con,$query);
      if(mysqli_num_rows($result)>0)
      while($row = mysqli_fetch_assoc($result)):?>
    
      <option><?=$row['name']?></option>
      <?php endwhile;
      ?>

    </select>
  </div>
              <label style= "color:white;"for="exampleFormControlTextarea1">Write here</label>
              <textarea class="form-control" name="content" id="myTextarea" rows="3"></textarea>
              <input type="file" name ="image" class="form-control" style="margin-top:15px">
              <button type="submit" class="btn btn-primary post2" >Publish</button>
              <button type="button" class="btn btn-primary post2"><a href="profile.php">Cancel</a></button>
                </div>
              </div>
            </div>
          </form>
         

          
                
             </div>
             <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
include "partials/footer.php";
?>