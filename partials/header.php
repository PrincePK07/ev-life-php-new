<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> <?php echo $title ?></title>

 
    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
   
      



<!-- Owl carousal style -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" />



<!-- fontawesome cdn -->
<link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

   <!-- custom css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="css/styleprofile.css">
    <link rel="stylesheet" href="css/stylepost.css">


    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
 
 <script>tinymce.init({selector:'#myTextarea'});</script>

  </head>
  <body>
  <div class="header">
      <div id="nav" class="sticky-nav">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <div class="container-fluid">
            <!-- ev life logo -->
            <a class="navbar-brand" href="#"
              ><img src="images/logos/evlife_logo@2x.png "
            /></a>
            <button
              class="navbar-toggler"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span class="navbar-toggler-icon"></span>
              <span></span>
              <span></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-auto">
                <li class="nav-item" id="nav-id">
                  <a class="nav-link "  href="./index.php" aria-current="page"
                    >Home</a
                  >
                </li>
                <li class="nav-item" id="nav-id">
                  <a class="nav-link"  href="#">About</a>
                </li>
                <li class="nav-item dropdown" id="nav-id">
                  <a
                    class="nav-link dropdown-toggle" 
                    href="#"
                    role="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  >
                    Blog
                  </a>
                  <ul class="dropdown-menu" id="nav-id">
                    <li><a class="dropdown-item"  href="./post.php">Create Post</a></li>
                    <li>
                      <a class="dropdown-item" id="nav-items" href="allpost.php">View Posts</a>
                    </li>
                    <li><hr class="dropdown-divider" /></li>
                    <li>
                      <a class="dropdown-item" href="#">under development </a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item" id="nav-id">
                  <a class="nav-link"  href="#">Models</a>
                </li>

                <li class="nav-item"  id="nav-id">
                  <a class="nav-link" href="#">Contact Us</a>
                </li>
              </ul>
              <!-- login logout sign up starts here -->
              <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-auto">
               <!-- login - logout profile  replacer -->
               <?php if(empty($_SESSION['info'])):?>
                <li class="nav-item" id="join-us" style="margin-top: 7px;">
                  <a href="./registration.php"><img src="images/logos/LogoJoin.png"></a>
                </li>
                <li style="padding-left: 17px;
                padding-top: 7px; "  >
                  <a class="btn btn-outline-light" href="./login.php"> LOGIN</a>
                </li>
                <?php else:?>
                  <li style="padding-left: 17px;
                padding-top: 7px; "  >
                  <a class="btn btn-success" href="./profile.php"> PROFILE</a>
                </li>
                <li style="padding-left: 17px;
                padding-top: 7px; "  >
                  <a class="btn btn-danger" href="./logout.php"> LOGOUT</a>
                </li>
                <?php endif;?>

              </ul>
              </form>
            </div>
          </div>
        </nav>
    </div>
    </div>
   
  
  
