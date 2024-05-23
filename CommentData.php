
<?php 
include('./includes/Functions.php');
include('./includes/Session.php');
?>  
<?php include("./inc/header.php");?>
<?php include("./inc/navbar.php");?>

<?php confirm_login();?>
<!-- category code start here -->
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
          <div class="col-lg-3 col-md-3 col-sm-6
           mb-2">
             <a href="Dashboard.php" class="btn btn-warning btn-block bg-success"><i class="fas fa-comments "></i> Aprove Comments</a>
          </div>
       </div> 
       <div class="container-fluid">
       <div class="row mb-3">
         <!-- Post card -->
          <div class="col-lg-2 col-sm-4 col-md-2 " >
            <div class="card text-center  bg-dark text-white mb-3">
              <div class="card-body ">
                <h1 class="lead"><a href="PostData.php" class="text-decoration-none text-light"> Posts</a></h1>
                <h4 class=" "><i class="fa fa-book-open"></i> <?php TotalPosts(); ?>  </h4>
              </div>
            </div>
              <!-- category card -->
            <div class="card text-center  bg-dark text-white mb-3">
              <div class="card-body ">
                <h1 class="lead"><a href="CategoryData.php" class="text-decoration-none text-light">Categories</a></h1>
                <h4 class=" "><i class="fa fa-folder"></i> <?php  TotalCotegories(); ?></h4>
              </div>
            </div>
             <!-- admins card -->
            <div class="card text-center  bg-dark text-white mb-3">
              <div class="card-body ">
                <h1 class="lead"><a href="AdminsData.php" class="text-decoration-none text-light">Admins</a></h1>
                <h4 class=""><i class="fa fa-user"></i> <?php TotalAdmins(); ?></h4>
              </div>
            </div>
              <!-- comments card -->
            <div class="card text-center  bg-dark text-white mb-3">
              <div class="card-body ">
                <h1 class="lead"><a href="CommentData.php"  class="text-decoration-none text-light">Approve</a></h1>
                <h4 class=""><i class="fa fa-comment"></i>  <?php TotalComments(); ?></h4>
              </div>
            </div>
          </div>
          <div class="col-lg-10 col-md-10 col-sm-8" >
            <!-- top categories card start here -->
          <h2 class="ml-2 text">Top Comments</h2>
            <div class="row ">
              <div class="col-lg-12">
              <table class="table table-striped table-hover">
        <thead class="thead-dark">
          <tr>
            <th>No. </th>
            <th>Date&Time</th>
            <th>Name</th>
            <th>Comments</th>
            <th>details</th>
          </tr>
        </thead>
        <!-- fetching category data from category table  database -->
      <?php
      global $ConnectingDB;
      $sql = "SELECT * FROM Comments ORDER BY id desc lIMIT 8";
      $Execute =$ConnectingDB->query($sql);
      $SrNo = 0;
      while ($DataRows=$Execute->fetch()) {
        $CommentId = $DataRows["id"];
        $Comment_DateTime = $DataRows["DateTime"];
        $Name =$DataRows['Name'];
        $Comment = $DataRows["Comments"];
        $SrNo++;
      ?>
      <tbody>
        <tr>
          <td><?php echo htmlentities($SrNo); ?></td>
          <td><?php echo htmlentities($Comment_DateTime); ?></td>
          <td><?php echo htmlentities($Name); ?></td>
          <td><?php echo htmlentities($Comment); ?></td>
          <td>  <a href="fullpost.php?id=<?php echo $CommentId;?>" target="_blank"><span class="btn btn-info">Preview</span></a></td>
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
