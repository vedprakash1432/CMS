
<?php 
include('./includes/Functions.php');
include('./includes/Session.php');
?>  
<?php include("./inc/header.php");?>
<?php include("./inc/navbar.php");?>
<?php confirm_login();?>

    <div class="container-fluid">
        <h2><i class="fas fa-cog text-info my-3"></i> Blog Posts</h2>
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
       <?php
        echo ErrorMessage();
        echo SuccessMessage();
      ?>
       <div class="container-fluid">
       <div class="row mb-3">
          <div class="col-lg-12 col-md-12 col-sm-12">
            
            <div class="row">
              <div class="col-lg-12">
                <table class="table table-striped table-hover">
                  <thead class="thead-dark">
                    <tr>
                     <th>#</th>
                      <th>Title</th>
                      <th>Category</th>
                      <th>Date&tTime</th>
                      <th>Auther</th>
                      <th>Banner</th>
                      <th>Comments</th>
                      <th>Action</th>
                      <th>Live Preview</th>
                    </tr>
                  </thead>
                  <?php
                   global $ConnectingDB;
                   $sql = "SELECT * FROM post ORDER BY id desc";
                   $Execute =$ConnectingDB->query($sql);
                   $SrNo = 0;
                   while ($DataRows=$Execute->fetch()) {
                   $PostId = $DataRows["id"];
                   $Post_Title =$DataRows['title'];
                   $Post_Category =$DataRows['category'];
                   $Auther = $DataRows["author"];
                   $Image = $DataRows["image"];
                   $DateTime = $DataRows["datetime"];
                   $Post  = $DataRows['post'];
                   $SrNo++;
                   ?>
                  <tbody>
                   <tr>
                    <td><?php echo htmlentities($SrNo); ?></td>
                    <td><?php echo htmlentities($Post_Title); ?></td>
                    <td><?php echo htmlentities($Post_Category); ?></td>
                    <td><?php echo htmlentities($Auther); ?></td>
                    <td><?php echo htmlentities($DateTime); ?></td>
                    <td><?php echo'<img src="./uploads/'.$Image.'" class="" alt="" style="width:100px; height:60px">'; ?></td>
                    <td><span class="badge badge-success"><?php echo ApproveComments();?></span>
                     <span class="badge badge-danger"><?php echo UnApproveComments();?></span>
                     </td>
                     <td><a href="EditPost.php? id=<?php echo $PostId;?>"><span class="">Edit</span></a>&nbsp;<a href="ConfirmDeletePost.php?id=<?php echo $PostId;?>"><span class="btn btn-danger">delete</span></a></td>
                    <td><a href="fullpost.php?id=<?php echo $PostId;?>" target="_blank"><span class="btn btn-info">Live Preview</span></a></td>
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