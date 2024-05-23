
<?php 
include('./includes/Functions.php');
include('./includes/Session.php');
?>  
<?php include("./inc/header.php");?>
<?php include("./inc/navbar.php");?>

<?php confirm_login();?>

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
             <a href="ApproveComments.php" class="btn btn-warning btn-block bg-success"><i class="fas fa-comments "></i> Aprove Comments</a>
          </div>
       </div> 
       <div class="container-fluid">
       <div class="row mb-3">
          <div class="col-lg-2 col-sm-4 col-md-2 " >
            <div class="card text-center  bg-dark text-white mb-3">
              <div class="card-body ">
                <h1 class="lead"><a href="PostData.php" class="text-decoration-none text-light"> Posts</a></h1>
                <h4 class="displ"><i class="fa fa-book-open"></i> <?php TotalPosts(); ?>  </h4>
              </div>
            </div>

            <div class="card text-center  bg-dark text-white mb-3">
              <div class="card-body ">
                <h1 class="lead"><a href="CategoryData.php" class="text-decoration-none text-light">Categories</a></h1>
                <h4 class="displ"><i class="fa fa-folder"></i> <?php  TotalCotegories(); ?></h4>
              </div>
            </div>
            
            <div class="card text-center  bg-dark text-white mb-3">
              <div class="card-body ">
                <h1 class="lead"><a href="AdminsData.php"  class="text-decoration-none text-light">Admins</a></h1>
                <h4 ><i class="fa fa-user"></i> <?php TotalAdmins(); ?></h4>
              </div>
            </div>

            <div class="card text-center  bg-dark text-white mb-3">
              <div class="card-body ">
                <h1 class="lead"><a href="CommentData.php"  class="text-decoration-none text-light">Comments</a></h1>
                <h4 class="displ"><i class="fa fa-comment"></i> <?php TotalComments();?></h4>
              </div>
            </div>
          </div>
          <div class="col-lg-10 col-md-10 col-sm-8 bg-light" >
             <!-- <div class="display-2 text-primary text-center">Welcome to Dashboard</div><br><br>
             <h2 class="text-danger text-center">Kindly please click any option!</h2> -->
              <!-- col-lg-10 area          -->
             <h2>Total Posts</h2>
             <div class="row">
               <div class="col-lg-12">
                <table class="table table-striped table-hover">
                  <thead class="thead-dark">
                    <tr>
                      <th>SrNo</th>
                      <th>Title</th>
                      <th>Category</th>
                      <th>Auther</th>
                      <th>Date</th>
                      <th>Comments</th>
                      <th>Details</th>
                    </tr>
                  </thead>
                  <?php
                   global $ConnectingDB;
                   $sql = "SELECT * FROM post ORDER BY id desc";
                   $Execute =$ConnectingDB->query($sql);
                   $SrNo = 0;
                   while ($DataRows=$Execute->fetch()) {
                   $Post_Id = $DataRows["id"];
                   $Post_Title =$DataRows['title'];
                   $Post_Category =$DataRows['category'];
                   $Post_Author = $DataRows["author"];
                   $Post_DateTime = $DataRows["datetime"];
                   $SrNo++;
                   ?>
                  <tbody>
                   <tr class="table-secondry">
                    <td><?php echo htmlentities($SrNo); ?></td>
                    <td><?php echo htmlentities($Post_Title); ?></td>
                    <td><?php echo htmlentities($Post_Category); ?></td>
                    <td><?php echo htmlentities($Post_Author); ?></td>
                    <td><?php echo htmlentities($Post_DateTime); ?></td>
                    <td><span class="badge badge-success"><?php echo ApproveComments();?></span>
                        <span class="badge badge-danger"><?php echo UnApproveComments();?></span>
                    </td>
                    <td> <a href="fullpost.php?id=<?php echo $Post_Id;?>" target="_blank"><span class="btn btn-info">Preview</span></a></td>
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