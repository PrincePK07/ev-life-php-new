<?php
require 'functions.php';
// check_login();
$title = "Home";
require_once 'partials/header.php';

?>


 <!-- all post styling -->

 <!-- <search bar> -->

<div class="blog-section paddingTB60 " style="background: white">
<div class="container">
	<div class="row">
	<div class="row justify-content-center" style="margin-top: 20px;">
                        <div class="col-12 col-md-10 col-lg-8">
                            <form class="card card-sm" method='GET' action="search.php">
                                <div class="card-body row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <i class="fas fa-search h4 text-body"></i>
                                    </div>
                                    <!--end of col-->
                                    <div class="col">
                                        <input class="form-control form-control-lg form-control-borderless" name ="searchBar" type="search" placeholder="Search topics or keywords" required>
                                    </div>
                                    <!--end of col-->
                                    <div class="col-auto">
                                        <button class="btn btn-lg btn-success"  >Search</button>
                                    </div>
                                    <!--end of col-->
</form>
                                </div>
                        </div>
                        <!--end of col-->
                    </div>

  
          
     
		<div class="site-heading text-center">
						<h3>ALL POSTS</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt <br> ut labore et dolore magna aliqua. Ut enim ad minim </p>
						<div class="border-allpost"></div>
					</div>
	</div>
	<div class="row text-center" style="margin-top:50px">

    <?php
     // to display only 6 posts -->
        
$limit = 6;
if(isset($_GET['page'])){
$page = $_GET['page'];
}else{
$page=1;
}
$offset = ($page-1)*$limit;

$query = "select * from post order by date desc limit {$offset},{$limit}";
$result = mysqli_query($con, $query);
    
    if (mysqli_num_rows($result) > 0): ?>
 <?php while ($row = mysqli_fetch_assoc($result)): ?>
	<?php if($row['status'] == 1):?>
     <?php
     $user_id = $row['user_id'];
     $query = "select username , image from profile where id ='$user_id' ";
     $result2 = mysqli_query($con, $query);
     $user_row = mysqli_fetch_assoc($result2);

	 $user_pic =$user_row['image'];
	 $default_pic = "uploads/default.png";
	 if(!empty( $user_row['image'])){
	 $profile_pic = $user_pic;
	 }else{
		 $profile_pic =$default_pic; 
	 }
	
     ?>




<div class="col-sm-6 col-md-4">
							<div class="blog-box">
								<div class="blog-box-image">
                                <?php if (file_exists($row['image'])): ?>
									<img src="<?php echo $row['image'] ?>" class="img-responsive" alt="">
									<div class="overlay">
    <div class="user-details" style="display:flex ;">

<img  src="<?php echo $profile_pic ?>"><span><?='<i class="fa-regular fa-user"></i> '.$user_row['username']?></span>
	</div>
  </div>
								</div>
                                <?php endif; ?>
								<div class="blog-box-content">
									<h4><a href="#"><?php echo '<b>'.substr($row['title'] , 0,30).'</b>';?></a></h4>
									<p><?php echo substr($row['post'], 0, 100) . '...'; ?></p>

									<a href="postdetails.php?id=<?=$row['id']?>" class="btn btn-default site-btn">Read More</a>
								</div>
							</div>
						</div> 
						<?php endif;?>
                        <?php endwhile; 
 endif;?><!-- End Col -->
 
 

 <nav >
 <!-- total page calculator -->
 <?php

$query = "select * from post where status = 1";
$result = mysqli_query($con,$query) or die("Query Failed.");

if(mysqli_num_rows($result)>0){
$totalRecords = mysqli_num_rows($result);
$limit = 6;
$totalPages = ceil($totalRecords/$limit);
}
 


echo '<ul class="pagination justify-content-center">';
if($page >1){
    echo'<li class="page-item"><a class="page-link" href="allpost.php?page='.($page-1).'">Previous</a></li>';
}

for($i=1 ; $i<= $totalPages ; $i++){
if( $i == $page){
    $active = "active";
}else{
    $active = "";
}
	
echo '<li class="page-item '.$active.'"><a class="page-link" href="allpost.php?page='.$i.'">'.$i.'</a></li>';
  
}
if($page < $totalPages){
    echo '<li class="page-item"><a class="page-link" href="allpost.php?page='.($page+1).'">Next</a></li>';
}
  
    
  echo'</ul>';

	?>
   
    </div>
</div>
</div>

<?php

include 'partials/footer.php';
?>