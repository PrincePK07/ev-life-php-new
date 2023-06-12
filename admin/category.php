<?php
require '../functions.php';
require 'partials/header.php';
check_login();
// insert query
if( $_SERVER['REQUEST_METHOD']=='POST' && !empty($_POST['category'])){
$cat = $_POST['category'];

 $query = "insert into category (name) values ('$cat')";
 $result = mysqli_query($con,$query);

 header("location:category.php");
  die;
//   delete query
}elseif( $_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['id'])){
$id= $_GET['id'];
$query = "delete from category where id = '$id'";
$result = mysqli_query($con,$query);

header("location:category.php");

}

?>



<div class="container-xxl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-5">
                        <h2>
                            <a class="navbar-brand" href="admin.php"><img
                                    src="../images/logos/evlife_logo@2x.png " /></a>User <b>Admin Panel <i
                                    class="fa-solid fa-screwdriver-wrench"></i></b>
                        </h2>
                    </div>
                    <div class="col-sm-7">
                    <a href="category.php?action=update_cat" class="btn btn-secondary"><i class="material-icons">&#xE147;</i>
                            <span>Add New Category</span></a>
                        <a href="../logout.php" class="btn btn-secondary"style="background:red; color: white;"><i class="fa-solid fa-right-from-bracket"></i>
                            <span>Admin Logout</span></a>

                <!-- displaying total users -->
<?php
$query = "select id from profile order by id ";
$result = mysqli_query($con,$query);
$count = mysqli_num_rows($result);
?>
                            <button class="btn btn-display" style="cursor:default"><i class="fa-solid fa-users"></i>
                            <span>Total Users:&nbsp;<b><?php echo "$count";?> </b></span></button>
                    </div>
                </div>
            </div>
            <?php if(!empty($_GET['action']) && $_GET['action']=="update_cat"):?>
                <form method="POST">
                <div class="form-group">
    <label for="exampleFormControlInput1">Enter the category</label>
    <div class="row">
        <div class="col">
    <input  name="category" style="width: 500px;" class="form-control" id="exampleFormControlInput1" placeholder="name">
    </div>
    <div class="col">
    <button style="display:inline" class="btn btn-info">Add</button>
    </div>
            </div>
  </div>
            </form>
          <?php else:?> <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Sl.No</th>
                            <th>Category Name</th>
                            <th>Delete</t>
                         </tr>
                    </thead>
                    <tbody>
                        <?php
                        // read query

$query = "select * from category";
$result= mysqli_query($con, $query);
$sl=1;
 if(mysqli_num_rows($result )> 0)
    while($row = mysqli_fetch_assoc($result)):?>

                        <tr>
                        <th><?=$sl?></th>
                            <th><?=$row['name']?></th>
                            <form method="POST">
                                <input type="hidden" name="delete" value="category">
                            <th><a href="category.php?id=<?=$row['id']?>" class="delete" title="Delete" data-toggle="tooltip"><i  class="fa-solid fa-trash"></i></a></th>
    </form>
                        </tr>
                      
                        <?php 
                          $sl++;
                    endwhile;
                endif;?>
                    

    

                    </tbody>
                    <?php
    require 'partials/footer.php';
    ?>