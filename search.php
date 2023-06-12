<?php
require 'functions.php';
// check_login();
$title = "search";
require_once 'partials/header.php';

if(isset($_GET['searchBar']))
$search = $_GET['searchBar'];	
$query = "select * from post where title like '%$search%' or post like '%$search%' or category like '%$search%'";
$result = mysqli_query($con,$query);
if(mysqli_num_rows($result)>0):?>

<div class="blog-section paddingTB60 " style="background: white">
<div class="container">

<div class="row">
	<div class="row justify-content-center" style="margin-top: 20px;">
                        <div class="col-12 col-md-10 col-lg-8">
                            <form class="card card-sm" method="GET" action="search.php?search=<?=$_GET['searchBar']?>">
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
                            </form>
                        </div>
                        <!--end of col-->
                    </div>
<div class="site-heading text-center">
<h2>Search result for "<?=$_GET['searchBar']?>"</h2> 
<div class="border-allpost"></div>
</div>
<div class="row text-center" style="margin-top:50px">


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
						<?php endif;
                     endwhile;?>
              
 <!-- End Col -->
 <?php else:?>
 <div class="alert alert-warning" role="alert">No data found </div>
  
    </div>
    <?php endif;?>
    </div>  
</div>
</div>
<?php
include 'partials/footer.php';
?>