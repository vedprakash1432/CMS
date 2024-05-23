<?php 
include('./includes/Functions.php');
include('./includes/Session.php');
?>
<?php include("./inc/header.php");?>
<?php include("./inc/navbar.php") ?>
<?php confirm_login();?>
<?php
    $UserId = $_SESSION['UserId'];

   if(isset($_POST['save'])){
     $AdminName = $_POST['name'];
     $Image     =$_FILES["Image"]["name"];
     $AdminBio  =$_POST['Bio'];
     $Target    = "uploads/".basename($_FILES["Image"]["name"]);
     move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);

   //echo //$AdminName.$AdminBio;
   
    $sql ="UPDATE admins SET aname='$AdminName',AdminImage='$Image',AdminBio='$AdminBio' WHERE id=$UserId";
    global $ConnectingDB;
    $Execute =$ConnectingDB->query($sql);
    if($Execute){
    $_SESSION["SuccessMessage"]="Profile Update Successfully";
    Redirect_to("MyProfile.php");
    }else {
    $_SESSION["ErrorMessage"]= "Something went wrong. Try Again to Update !";
    Redirect_to("MyProfile.php");
    }
}
?>

<?php
    $UserId = $_SESSION['UserId'];
    global $connectingDB;
    $sql = "SELECT * FROM admins WHERE id=$UserId";
    $Execute =$ConnectingDB->query($sql);
    while($DataRows=$Execute->fetch()){
        $Admin_Id =$DataRows['id'];
        $Admin_Name =$DataRows['aname'];
        $Admin_Username =$DataRows['username'];
        $AddedBy  =$DataRows['AddedBy']; 
        $Admin_Image =$DataRows['AdminImage'];
        $Admin_Bio =$DataRows['AdminBio'];
    }
  ?>
<section class="container py-2 mb-4">
    <div class="container mb-3">
    <h1><i class="fas fa-user text-success"></i> <?php echo $Admin_Username; ?></h1>
    <small>Designer</small>
    </div>
    <?php
        echo ErrorMessage();
        echo SuccessMessage();
      ?>
  <div class="row">
      <div class="col-lg-3 col-sm-12">
        <div class="container">
            <div class="card-header bg-dark text-light text-center"><h4><?php echo $Admin_Name;?></h4></div>
            <div class="card">
              <img src="./uploads/<?php echo  htmlentities( $Admin_Image); ?>" style="width:225px; height:200px;border: 1px solid black; border-radius: 50%;" alt="Missing Neha">           
              <div class="card-body">
                  <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Impedit ullam consequatur sint! Suscipit, porro officia, ullam delectus atque cumque iure consequatur, ducimus eius corrupti deserunt omnis voluptatum dolor libero repudiandae?</p>
              </div>
          </div>
        </div>
      </div>
    <div class="col-lg-9 col-sm-12">
     <header class="bg-dark text-white py-3">
      <div class="container">
        <div class="row">
         <div class="col-md-12">
         <h2><i class="fas fa-edit text-warning "></i> Edit Porfile</h2>
        </div>
       </div>
      </div>
     </header>
      <form class="" action="" method="POST" enctype="multipart/form-data">
        <div class="card bg-secondary text-light mb-3">
          <div class="card-body" style="background-color: black;">
            <div class="form-group">
               <input class="form-control" type="text" name="name" id="name" value="<?php echo $Admin_Name;?>" placeholder="Your Name">
            </div>
            <div class="form-group">
             <input class="form-control" type="text" name="headline" id="headline" placeholder="headline">
            </div>
            <div class="form-group">
              <textarea class="form-control" id="Bio" name="Bio" value="" rows="6" cols="80" placeholder="<?php echo$Admin_Bio;?>"></textarea>
            </div>
            <div class="form-group">
               <div class="custom-file">
                <label for="imageSelect" class="custom-file-label">Select Image </label>
                <input class="custom-file-input" type="File" name="Image" id="imageSelect" value="">
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6 mb-2">
                <a href="Dashboard.php" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i> Back To Dashboard</a>
              </div>
              <div class="col-lg-6 mb-2">
                <input type="submit" class="btn btn-success btn-block" value="Publish" name="save">
                 <!-- <a href="UpdateProfile.php?UserId=<?php echo $UserId;?>" class="btn btn-success btn-block">Update</a> -->
              </div>
            </div>
          </div>
        </div>
      </form>
     </div>
    </div>
  </div>
</section>
    <!-- End Main Area -->
 
<?php include("./inc/footer.php");?>
 
