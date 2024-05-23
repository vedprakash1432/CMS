
<?php 
include('./includes/Functions.php');
include('./includes/Session.php');
?>  
<?php include("./inc/header.php");?>
<?php include("./inc/navbar.php");?>

    <div class="container-fluid">
        <h2 ><i class="fas fa-cog text-info"></i> Dasshboard</h2>
        <div class="row">
          <div class="col-lg-3 col-md-3 col-sm-6 mb-2">
             <a href="AddNewPost.php" class="btn btn-warning btn-block bg-primary"><i class="fas fa-edit "></i> Add New Post</a>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-6 mb-2">
             <a href="category.php" class="btn btn-warning btn-block bg-info"><i class="fas fa-folder-plus "></i> Add New Category</a>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-6 mb-2">
             <a href="AddNewAdmin.php" class="btn btn-warning btn-block bg-warning"><i class="fas fa-user-plus "></i> Add New Admin</a>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-6 mb-2">
             <a href="Dashboard.php" class="btn btn-warning btn-block bg-success"><i class="fas fa-comments "></i> Aprove Comments</a>
          </div>
       </div> 
       <div class="container-fluid">
       <div class="row mb-3">
          <div class="col-lg-2 col-sm-4 col-md-2 " >
            <div class="card text-center  bg-dark text-white mb-3">
              <div class="card-body ">
                <h1 class="lead"><a href="PostData.php" class="text-decoration-none text-light"> Posts</a></h1>
                <h4 class=" "><i class="fa fa-book-open"></i> <?php TotalPosts(); ?>  </h4>
              </div>
            </div>

            <div class="card text-center  bg-dark text-white mb-3">
              <div class="card-body ">
                <h1 class="lead"><a href="CategoryData.php" class="text-decoration-none text-light">Categories</a></h1>
                <h4 class=" "><i class="fa fa-folder"></i> <?php  TotalCotegories(); ?></h4>
              </div>
            </div>
            
            <div class="card text-center  bg-dark text-white mb-3">
              <div class="card-body ">
                <h1 class="lead"><a href="AdminsData.php" class="text-decoration-none text-light">Admins</a></h1>
                <h4 class=" "><i class="fa fa-user"></i> <?php TotalAdmins(); ?></h4>
              </div>
            </div>

            <div class="card text-center  bg-dark text-white mb-3">
              <div class="card-body ">
                <h1 class="lead"><a href="CommentData.php"  class="text-decoration-none text-light">Approve</a></h1>
                <h4 class=" "> <i class="fa fa-comment"> </i> <?php TotalComments(); ?></h4>
              </div>
            </div>
          </div>
          <div class="col-lg-10 col-md-10 col-sm-8">
            
          <h2 class="ml-2 text">Top Admins</h2>
            <div class="row ">
              <div class="col-lg-12">
              <table class="table table-striped table-hover">
              <thead class="thead-dark">
          <tr>
            <th>No. </th>
            <th>Date&Time</th>
            <th>Username</th>
            <th>Admin Name</th>
            <th>Added by</th>
            <th>details</th>
          </tr>
        </thead>
      <?php
      global $ConnectingDB;
      $sql = "SELECT * FROM admins ORDER BY id desc";
      $Execute =$ConnectingDB->query($sql);
      $SrNo = 0;
      while ($DataRows=$Execute->fetch()) {
        $AdminId = $DataRows["id"];
        $DateTime = $DataRows["datetime"];
        $AdminUsername = $DataRows["username"];
        $AdminName= $DataRows["aname"];
        // $AddedBy = $DataRows["AddedBy"];
        $AddedBy ="vedprakash_sharma";
        $SrNo++;
      ?>
      <tbody>
        <tr>
          <td><?php echo htmlentities($SrNo); ?></td>
          <td><?php echo htmlentities($DateTime); ?></td>
          <td><?php echo htmlentities($AdminUsername); ?></td>
          <td><?php echo htmlentities($AdminName); ?></td>
          <td><?php echo htmlentities($AddedBy); ?></td>
          <td><a href="#" target="_blank"><span class="btn btn-info">Preview</span></a></td>
      </tr>    
      </tbody>
      <?php } ?>
      </table>

              </div>
            </div>

          </div>
        </div>
       </div>
    </div>
<?php include("./inc/footer.php");?>