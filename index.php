<?php
require 'functions.php';
// check_login();
$title = "Home";
require_once 'partials/header.php';

?>

<!-- slider -->


<div id="hero-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="0" class="active" aria-current="true"
      aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active c-item">
      <img src="images/carousal/mustang-g79ac23378_1280.jpg" class="d-block w-100 c-img" alt="Slide 1">
      <div class="carousel-caption  top-0 mt-4">
        <p class="mt-5 fs-3 text-uppercase" style="color:white" >Discover the hidden world</p>
        <h1 class="display-1 fw-bolder text-capitalize">Mobility with EVs</h1>

        <!-- buttons -->

        <div class="slider-btn">
          <button class="btn btn-1">News</button>
          <button class="btn btn-2">Explore</button>

        </div>
      </div>
    </div>
    <div class="carousel-item c-item">
      <img src="images/carousal/car-gc9717681a_1280.jpg" class="d-block w-100 c-img" alt="Slide 2">
      <div class="carousel-caption  top-0 mt-4">
        <p class="text-uppercase fs-3 mt-5" style="color:white">Discover the hidden world</p>
        <h1 class="display-1 fw-bolder text-capitalize">Mobility with EVs</h1>

        <div class="slider-btn">
          <button class="btn btn-1">News</button>
          <button class="btn btn-2">Explore</button>

        </div>
      </div>
    </div>
    <div class="carousel-item c-item">
      <img src="images/carousal/bmw-m4-gecb39ec52_1280.jpg" class="d-block w-100 c-img" alt="Slide 3">
      <div class="carousel-caption  top-0 mt-4">
        <p class="text-uppercase fs-3 mt-5" style="color:white">Discover the hidden world</p>
        <h1 class="display-1 fw-bolder text-capitalize"> Mobility with EVs </h1>

        <div class="slider-btn">
          <button class="btn btn-1">News</button>
          <button class="btn btn-2">Explore</button>

        </div>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#hero-carousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#hero-carousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<!-- slider ends -->

<!-- features section starts here -->
<section class="features">
  <h2 style="color:white; ">Awesome Features</h2>
  <p style="color:white;">
    Lorem ipsum dolor sit amet, consectetur adipiscing elit nostrud
    exercitation
  </p>
  <div class="mainCard">
    <div class="cards">
      <img src="images/logos/heart-circle-bolt-solid.png" />
      <h3>Energy Efficient</h3>
      <p>Lorem ipsum dolor sit amet</p>
    </div>
    <div class="cards">
      <img src="images/logos/LogoMakr-6X55qm.png" />
      <h3>Go Green</h3>
      <p>Lorem ipsum dolor sit amet</p>
    </div>
    <div class="cards">
      <img src="images/logos/LogoMakr-9YMTYS.png" />
      <h3>Less Maintainence</h3>
      <p>Lorem ipsum dolor sit amet</p>
    </div>
  </div>
</section>

<!-- news carousal starts here -->
<?php
  
  $query = "select * from post where status = 1 order by id  desc limit 10";
  $result = mysqli_query($con, $query);
  $num_rows = mysqli_num_rows($result); // get total number of rows
 var_dump($num_rows);
?>
<section class="testimonials">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div id="customers-testimonials" class="owl-carousel">
         
          <?php if ($num_rows > 0): ?>
            <?php $i = 1; ?>
            <?php while ($row = mysqli_fetch_assoc($result)):?>
            
                <!-- news  -->
                <div class="item" >
                  <div class="shadow-effect">
                    <a href="postdetails.php?id=<?=$row['id']?>"><img href = "postdetails.php" decoding="async" class="img-circle" src="<?php echo $row['image'] ?>" style="height:120px" alt=""></a>
                   <p><?php echo "<b>".substr($row['title'] , 0 ,25 )."</b>"?></p> 
                   <p>
    <?php echo substr($row['post'], 0, 140).'...'; ?>
</p>
               </div>
                  <?php if ($i == $num_rows): ?>
                    <div class="testimonial-name">
                      <a href="allpost.php">View All Posts</a>
                    </div>
                  <?php endif; ?>
                </div>
             
              <?php $i++; ?>
            <?php endwhile; ?>
          <?php endif; ?>
         
        </div>
      </div>
    </div>
  </div>
</section>

<?php
require_once 'partials/footer.php';
?>
