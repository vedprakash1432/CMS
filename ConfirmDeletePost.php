<?php 
include('./includes/Functions.php');
include('./includes/Session.php');
?>
<?php include("./inc/header.php");?>

<?php 
$id=$_GET['id'];
?>
<section class="container py-2 my-4">
  <div class="row">
    <div class="offset-lg-1 col-lg-10">
      <form class="" action="" method="post">
        <div class="card bg-dark text-light mb-3">
          <?php 
          $PostId =null;
          $Post_Title =null;
          $Post_Category= null;
          $Post =null;
          $Image =null;
          $Auther =null;
          $DateTime =null;
           global $ConnectingDB;
           $sql = "SELECT * FROM post where id=$id";
           $Execute =$ConnectingDB->query($sql);
           while ($DataRows=$Execute->fetch()) {
           $PostId = $DataRows["id"];
           $Post_Title =$DataRows['title'];
           $Post_Category =$DataRows['category'];
           $Auther = $DataRows["author"];
           $Image = $DataRows["image"];
           $DateTime = $DataRows["datetime"];
           $Post  = $DataRows['post'];
          ?>
          <?php } ?>
          <div class="card-header">
            <h2><i class="fas fa-trash text-secondary"></i> Delete Post</h2>
          </div>
          <div class="card-body bg-dark text-light">
            <div class="form-group">
              <label for="username"> <span class="FieldInfo"> Post Title: </span></label>
              <input class="form-control" type="text" placeholder="<?php echo $Post_Title; ?>" name="title">
            </div>
            <div class="form-group">
              <label for="Name"> <span class="FieldInfo">Existing Cotegory: </span> <b class="text-light"> <?php echo $Post_Category;?></b></label>
            </div>

            <div class="form-group">
              <label for="image"> <span class="FieldInfo"> Existing Image: </span></label> &nbsp;&nbsp;<?php echo'<img src="./uploads/'.$Image.'" class="" alt="" style="width:150px; height:60px" alt="">';?>
            </div>
            <div class="form-group">
              <label for="ConfirmPassword"> <span class="FieldInfo"> Post Description:</span></label>
              <textarea name="description" placeholder="<?php echo $Post; ?>" cols="50" rows="10" class="form-control"></textarea>
            </div>
            <div class="row">
              <div class="col-lg-6 mb-2">
                <a href="Dashboard.php" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i> Back To
                  Dashboard</a>
              </div>
              <div class="col-lg-6 mb-2">
              <a href="DeletePost.php?id=<?php echo $PostId;?>" onclick="return confirm('Are you sure! Do you want to delete this item?');" class="btn btn-danger btn-block"><i class="fa fa-trash"></i> Delete</a>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>