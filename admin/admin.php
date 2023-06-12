<?php
require '../functions.php';
require 'partials/header.php';
check_login();




// <!-- db query  -->

// delete

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['action']) && $_POST['check'] == "admin_delete") {

    $id = $_GET['id'] ?? 0;

    $query = "delete from profile where id ='$id'";
    $result = mysqli_query($con, $query);
    header("Location:admin.php");
    die;
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
                        <a href="category.php" class="btn btn-secondary"><i class="fa-solid fa-sitemap"></i>
                            <span>Categories</span></a>
                        <a href="../logout.php" class="btn btn-secondary" style="background:red; color: white;"><i
                                class="fa-solid fa-right-from-bracket"></i>
                            <span>Admin Logout</span></a>
                        <!-- displaying total users -->
                        <?php
                        $query = "select id from profile order by id ";
                        $result = mysqli_query($con, $query);
                        $count = mysqli_num_rows($result);
                        ?>
                        <button class="btn btn-display" style="cursor:default"><i class="fa-solid fa-users"></i>
                            <span>Total Users:&nbsp;<b>
                                    <?php echo "$count"; ?>
                                </b></span></button>
                    </div>
                </div>
            </div>



            <!-- if clicked on info button -->
            <?php if (!empty($_GET['action']) && $_GET['action'] == 'adminEdit'): ?>
                <?php
                $id = $_GET['id'];

                $query = "select * from profile where id = '$id'";
                $result = mysqli_query($con, $query);
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);

                }
                ?>
                <h1 class="text-primary">Profile Info</h1>
                <hr>
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-3">
                        <div class="text-center">
                            <div style="width:166px;height:200px;">
                                <img src="../<?php echo $row['image'] ?>" class="avatar img-circle img-thumbnail "
                                    alt="user-image">
                            </div>
                        </div>
                    </div>

                    <!-- edit form column -->
                    <div class="col-md-9 personal-info">
                        <h3>Personal info</h3>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">User Name:</label>
                            <div class="col-lg-8">
                                <input value="<?php echo $row['username'] ?>" class="form-control" name="username"
                                    type="text" placeholder="username" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Email:</label>
                            <div class="col-lg-8">
                                <input value="<?php echo $row['email'] ?>" class="form-control" name="email" type="text"
                                    placeholder="email" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Phone no:</label>
                            <div class="col-lg-8">
                                <input value="<?php echo $row['number'] ?>" class="form-control" name="password"
                                    placeholder="password" disabled>
                            </div>
                        </div>
                        <div class="submit-button" style=" padding: 20px 0px;">
                            <a href="admin.php"><button type="button" class="btn btn-secondary">Back</button></a>
                        </div>
                        </form>
                    </div>
                </div>
                <!-- if clicked on delete button -->
            <?php elseif (!empty($_GET['action']) && $_GET['action'] == 'adminDelete'): ?>
                <?php $id = $_GET['id'];
                $query = "select * from profile where id ='$id' ";
                $result = mysqli_query($con, $query);
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                }

                ?>
                <h1 class="text-primary">Are you sure want to delete the profile &#63;
                </h1>
                <hr>
                <div id="delete-page-info">

                    <form method="POST" class="form-horizontal" id="delete-profile">
                        <input type="hidden" name="check" value="admin_delete">
                        <div>
                            <div class="text-center">
                                <div style="width:166px;height:200px; margin-bottom: 45px;">
                                    <img src="../<?php echo $row['image'] ?>" class="avatar img-circle img-thumbnail "
                                        alt="user-image">
                                </div>
                            </div>
                        </div>

                        <div>
                            <div><label>Name:&nbsp;</label>
                                <?php echo $row['username'] ?>
                            </div>
                            <div> <label>Email:&nbsp;&nbsp;</label>
                                <?php echo $row['email'] ?>
                            </div>
                            <input type="hidden" name="action" value="delete">
                            <hr>

                            <div class="submit-button" style=" padding: 20px 0px;">
                                <a href="admin.php"><button type="button" class="btn btn-secondary">Cancel</button></a>
                                <button type="submit" class="btn btn-primary">Delete</button>
                            </div>

                        </div>

                    </form>
                </div>
                <!-- if clicked on view post -->

            <?php elseif (!empty($_GET['action']) && $_GET['action'] == 'view_post'): ?>
                <?php $id = $_GET['id'];
                $query = "select * from post where user_id = '$id'";
                $result = mysqli_query($con, $query);
                ?>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Sl.No</th>
                            <th>Blog Title</th>
                            <th>Editor</th>
                            <th>Date Created</th>
                            <th>Category</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <?php
                    $sl = 1;
                    if (mysqli_num_rows($result) > 0)
                        while ($row = mysqli_fetch_assoc($result)): ?>
                            <tbody>
                                <tr>
                                    <td>
                                        <?= $sl ?>
                                    </td>
                                    <td>
                                        <?= $row['title'] ?>
                                    </td>
                                    <td>
                                        <?= $row['editor'] ?>
                                    </td>
                                    <td>
                                        <?php $format = date_create($row['date']);
                                        echo date_format($format, "Y/m/d H:i:s"); ?>
                                    </td>
                                    <td>
                                        <?= $row['category'] ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($row['status'] == 0) {
                                            echo '<a href="post_status.php?id=' . $row['id'] . '&status=1"><button type="button" class="btn btn-danger">Pending</button></a>';
                                        } elseif ($row['status'] == 1) {
                                            echo '<a href="post_status.php?id=' . $row['id'] . '&status=0"><button type="button" class="btn btn-success">Approved</button></a>';
                                        }
                                        ?>
                                    </td>
                                </tr>


                                <?php
                                $sl++;
                        endwhile;
                    ?>



                    </tbody>

<!-- when clicked searching -->

<?php elseif(!empty($_GET['searchBar'])) :?>

 <?php
$query = "select image from profile ";
$result = mysqli_query($con, $query);
$row2 = mysqli_fetch_assoc($result);

?>

<table class="table table-striped table-hover">
<!-- serach bar -->
    <div class="input-group justify-content-end">
        <div class="form-outline" style="width:250px">
        <form method='GET' action="admin.php?search=$_GET['searchBar']">
            <input type="search" id="form1" class="form-control" name="searchBar" />
         
            <label class="form-label" for="form1">Search a user</label>
        </div>
        <button type="submit" class="btn btn-primary" style="height: 38px">
            <i class="fas fa-search"></i>
        </button>
                    </form>
    </div>


    <thead>
        <tr>
            <th>Sl.No</th>
            <th>Name</th>
            <th>Date Created</th>
            <th>Role</th>
            <th>Email</th>
            <th>Status</th>
            <th>Action</th>
            <th>View Posts</th>

        </tr>
    </thead>
    <!-- query + // pagination query -->
    <?php
                        $sl = 1;
                        $limit = 6;
                        if (empty($_GET['page'])) {
                            $page = 1;

                        } else {
                            $page = $_GET['page'];

                        }

                        $offset = ($page - 1) * $limit;


                        $search = $_GET['searchBar'];
                        $query = "select * from profile where username like '%$search%' limit {$offset},{$limit}";
                        $result = mysqli_query($con, $query);
                        ?>
                        <tbody>

                            <?php

                            if (mysqli_num_rows($result) > 0): ?>

                                <?php while ($row = mysqli_fetch_assoc($result)): ?>

                                    <?php $user_pic = $row['image'];
                                    $default_pic = "uploads/default.png";
                                    if (!empty($row['image'])) {
                                        $profile_pic = $user_pic;
                                    } else {
                                        $profile_pic = $default_pic;
                                    }
                                    ?>

                                    <tr>
                                        <td>
                                            <?php echo ($offset + $sl) ?>
                                        </td>
                                        <td><img alt="profile-pic" class="img-circle" src="<?php echo "../" . $profile_pic ?>">&nbsp;
                                            &nbsp;<?php echo $row['username'] ?></td>
                                        <td>
                                            <?php $format = date_create($row['date']);
                                            echo date_format($format, "Y/m/d H:i:s"); ?>
                                        </td>
                                        <td>
                                            <?php echo $row['user_type'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row['email'] ?>
                                        <td>
                                            <?php
                                            if ($row['status'] == 0 && $row['user_type'] == 'user') {
                                                echo '<a href="status.php?id=' . $row['id'] . '&status=1"><span class="status text-danger">&bull;</span> Inactive</a>';
                                            } elseif ($row['status'] == 0 && $row['user_type'] == 'admin') {
                                                echo '<a><span class="status text-danger">&bull;</span>Restricted</a>';
                                            } else {
                                                echo '<a href="status.php?id=' . $row['id'] . '&status=0"><span class="status text-success">&bull;</span> Active</a>';

                                            }
                                            ?>
                                        </td>
                                        <td style="width:150px">
                                            <form>
                                                <?php if ($row['user_type'] == 'user'): ?>
                                                    <a href="admin.php?action=adminEdit&id=<?= $row['id'] ?>" class="settings"
                                                        title="Settings" data-toggle="tooltip"><i style="color:green"
                                                            class="fa-solid fa-circle-info "></i></a>
                                                    <a href="admin.php?action=adminDelete&id=<?= $row['id'] ?>" class="delete"
                                                        title="Delete" data-toggle="tooltip"><i style="padding-left:18px;"
                                                            class="fa-solid fa-trash"></i></a>
                                                <?php else: ?>
                                                    <a><span class="status text-danger">&bull;</span>Restricted</a>
                                                <?php endif; ?>
                                            </form>
                                        </td>
                                        <td>
                                            <a href="admin.php?action=view_post&id=<?= $row['id'] ?>"><i
                                                    class="fa-solid fa-sliders"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                    $sl++;
                                endwhile;
                            endif;

                            ?>
                               </tbody>
                    </table>
                    
                    <!-- pagination starts here -->
                    <?php
                    $query = "select * from profile";
                    $result = mysqli_query($con, $query);
                    if (mysqli_num_rows($result) > 0) {
                        $totalRecords = mysqli_num_rows($result);

                        $totalPages = ceil($totalRecords / $limit);
                    }
                    echo '<ul class="pagination justify-content-center">';
                    if ($page > 1) {
                        echo '<li class="page-item" ><a class="page-link" href="admin.php?page=' . ($page - 1) . '">Previous</a></li>';
                    }
                    for ($i = 1; $i <= $totalPages; $i++) {
                        echo '<li class="page-item" ><a class="page-link" href="admin.php?page=' . $i . '">' . $i . '</a></li>';
                    }
                    if ($page < $totalPages) {
                        echo '<li class="page-item" ><a class="page-link" href="admin.php?page=' . ($page + 1) . '">Next</a></li>';
                    }
                    echo '</ul>';
                    ?>





                    <!-- if clicked on nothing -->

                <?php else: ?>


                    <?php

                    $query = "select image from profile ";
                    $result = mysqli_query($con, $query);
                    $row2 = mysqli_fetch_assoc($result);

                    ?>

                    <table class="table table-striped table-hover">
<!-- serach bar -->
                        <div class="input-group justify-content-end">
                            <div class="form-outline" style="width:250px">
                            <form method='GET' action="admin.php?search=$_GET['searchBar']">
                                <input type="search" id="form1" class="form-control" name="searchBar" />
                                <label class="form-label" for="form1">Search a user</label>
                            </div>
                            <button type="submit" class="btn btn-primary" style="height: 38px">
                                <i class="fas fa-search"></i>
                            </button>
                            <form>
                        </div>


                        <thead>
                            <tr>
                                <th>Sl.No</th>
                                <th>Name</th>
                                <th>Date Created</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th>View Posts</th>

                            </tr>
                        </thead>
                        <!-- query + // pagination query -->
                        <?php
                        $sl = 1;
                        $limit = 6;
                        if (empty($_GET['page'])) {
                            $page = 1;

                        } else {
                            $page = $_GET['page'];

                        }

                        $offset = ($page - 1) * $limit;

                        $query = "select * from profile limit {$offset},{$limit}";
                        $result = mysqli_query($con, $query);
                        ?>
                        <tbody>

                            <?php

                            if (mysqli_num_rows($result) > 0): ?>

                                <?php while ($row = mysqli_fetch_assoc($result)): ?>

                                    <?php $user_pic = $row['image'];
                                    $default_pic = "uploads/default.png";
                                    if (!empty($row['image'])) {
                                        $profile_pic = $user_pic;
                                    } else {
                                        $profile_pic = $default_pic;
                                    }
                                    ?>

                                    <tr>
                                        <td>
                                            <?php echo ($offset + $sl) ?>
                                        </td>
                                        <td><img alt="profile-pic" class="img-circle" src="<?php echo "../" . $profile_pic ?>">&nbsp;
                                            &nbsp;<?php echo $row['username'] ?></td>
                                        <td>
                                            <?php $format = date_create($row['date']);
                                            echo date_format($format, "Y/m/d H:i:s"); ?>
                                        </td>
                                        <td>
                                            <?php echo $row['user_type'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row['email'] ?>
                                        <td>
                                            <?php
                                            if ($row['status'] == 0 && $row['user_type'] == 'user') {
                                                echo '<a href="status.php?id=' . $row['id'] . '&status=1"><span class="status text-danger">&bull;</span> Inactive</a>';
                                            } elseif ($row['status'] == 0 && $row['user_type'] == 'admin') {
                                                echo '<a><span class="status text-danger">&bull;</span>Restricted</a>';
                                            } else {
                                                echo '<a href="status.php?id=' . $row['id'] . '&status=0"><span class="status text-success">&bull;</span> Active</a>';

                                            }
                                            ?>
                                        </td>
                                        <td style="width:150px">
                                            <form>
                                                <?php if ($row['user_type'] == 'user'): ?>
                                                    <a href="admin.php?action=adminEdit&id=<?= $row['id'] ?>" class="settings"
                                                        title="Settings" data-toggle="tooltip"><i style="color:green"
                                                            class="fa-solid fa-circle-info "></i></a>
                                                    <a href="admin.php?action=adminDelete&id=<?= $row['id'] ?>" class="delete"
                                                        title="Delete" data-toggle="tooltip"><i style="padding-left:18px;"
                                                            class="fa-solid fa-trash"></i></a>
                                                <?php else: ?>
                                                    <a><span class="status text-danger">&bull;</span>Restricted</a>
                                                <?php endif; ?>
                                            </form>
                                        </td>
                                        <td>
                                            <a href="admin.php?action=view_post&id=<?= $row['id'] ?>"><i
                                                    class="fa-solid fa-sliders"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                    $sl++;
                                endwhile;
                            endif;

                            ?>


                        </tbody>
                    </table>

                    <!-- pagination starts here -->
                    <?php
                    $query = "select * from profile";
                    $result = mysqli_query($con, $query);
                    if (mysqli_num_rows($result) > 0) {
                        $totalRecords = mysqli_num_rows($result);

                        $totalPages = ceil($totalRecords / $limit);
                    }
                    echo '<ul class="pagination justify-content-center">';
                    if ($page > 1) {
                        echo '<li class="page-item" ><a class="page-link" href="admin.php?page=' . ($page - 1) . '">Previous</a></li>';
                    }
                    for ($i = 1; $i <= $totalPages; $i++) {
                        echo '<li class="page-item" ><a class="page-link" href="admin.php?page=' . $i . '">' . $i . '</a></li>';
                    }
                    if ($page < $totalPages) {
                        echo '<li class="page-item" ><a class="page-link" href="admin.php?page=' . ($page + 1) . '">Next</a></li>';
                    }
                    echo '</ul>';
                    ?>
            </div>
        </div>
    </div>

    <?php
    require 'partials/footer.php';
            endif;
            ?>