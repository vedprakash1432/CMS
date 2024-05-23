<?php 
include('./includes/Functions.php');
include('./includes/Session.php');
?>
<?php already_login(); ?>

<!-- copy code of add new admin start here-->

<?php
if(isset($_POST["Submit"])){
  $Admin_UserName        = $_POST["username"];
  $Admin_Name            = $_POST["name"];
  $Admin_Password        = $_POST["password"];
  $Admin_ConfirmPassword = $_POST["ConPassword"];
  $Admin_Bio             =$_POST['Bio'];
  $Admin_Image            = $_FILES["Image"]["name"];
  $First_Admin_Name    ="Myself";
  $Target                = "uploads/".basename($_FILES["Image"]["name"]);
  move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);
  $CurrentTime=time();
  date_default_timezone_set("Asia/Kolkata");
  $Admin_DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);

  
  // admin userName and admin password empty validation 
  if(empty($Admin_UserName)||empty($Admin_Password)){
    $_SESSION["ErrorMessage"]= "All fields must be filled out";
    Redirect_to("registration.php");
  }elseif (strlen($Admin_Password)<4) {
    $_SESSION["ErrorMessage"]= "Password should be greater than 3 characters";
    Redirect_to("registration.php");
  }elseif ($Admin_Password != $Admin_ConfirmPassword) {
    $_SESSION["ErrorMessage"]= "Password and Confirm Password should match";
    Redirect_to("registration.php");
  }elseif (CheckUserNameExistsOrNot($Admin_UserName)) {
    $_SESSION["ErrorMessage"]= "Username Exists. Try Another One! ";
    Redirect_to("registration.php");
  }else{
    // Query to insert new admin in DB When everything is fine
    global $ConnectingDB;
    $sql = "INSERT INTO admins(aname,username,password,AdminImage,AdminBio,datetime,AddedBy)";
    $sql .= "VALUES(:aName,:userName,:password,:adminImage,:adminBio,:dateTime,:AddedBy)";
    $stmt = $ConnectingDB->prepare($sql);
    $stmt->bindValue(':aName',$Admin_Name);
    $stmt->bindValue(':userName',$Admin_UserName);
    $stmt->bindValue(':password',$Admin_Password);
    $stmt->bindValue(':adminImage',$Admin_Image);
    $stmt->bindValue(':adminBio',$Admin_Bio);
    $stmt->bindValue(':dateTime',$Admin_DateTime);
    $stmt->bindValue(':AddedBy',$First_Admin_Name);
    $Execute=$stmt->execute();
    if($Execute){
      $_SESSION["SuccessMessage"]="hi".$Admin_Name."! you registered Successfully";
      Redirect_to("index.php");
    }else {
      $_SESSION["ErrorMessage"]= "Something went wrong. Try Again !";
      Redirect_to("registration.php");
    }
  }
} //Ending of Submit Button If-Condition
?>
<!-- insert query code end here-->

<?php include("./inc/header.php");?>
<?php include("./inc/navbar.php");?>

  <header class="bg-dark text-white py-3 mt-3">
    <div class="container">
      <div class="row">
          <div class="col-md-12">
          <h2>Ragistration Form</h2>
        </div>
      </div>
    </div>
  </header>
  <section class="container py-2 mb-4">
      <div class="row">
    <div class="offset-lg-1 col-lg-10" style="min-height:400px;">
      <form class="" action="registration.php" method="post" enctype="multipart/form-data">
        <div class="card bg-secondary text-light mb-3">
          <div class="card-body bg-dark">
            <div class="form-group">
              <label for="name"> <span class="FieldInfo">Name: </span></label>
               <input class="form-control" type="text" name="name" id="title" placeholder="Enter name">
            </div>
            <div class="form-group">
              <label for="User"> <span class="FieldInfo">Username </span></label>
               <input type="text" name="username" class="form-control" id="username" placeholder="Enter username">
            </div>

            <div class="form-group">
              <div class="custom-file">
                <label for="imageSelect" class="custom-file-label">Select Image </label>
                <input class="custom-file-input" type="File" name="Image" id="imageSelect" value="">
              </div>
            </div>
            <div class="form-group">
              <label for=""><span>Enter Bio:</span></label>
              <textarea name="Bio" id="bio" rows="10" class="form-control"></textarea>
            </div>

            <div class="form-group">
              <label for="password"> <span class="FieldInfo">Password: </span></label>
              <input type="text" name="password" id="password" placeholder="Enter password" class="form-control">
            </div>
            <div class="form-group">
              <label for="ConPassword"> <span class="FieldInfo">Confirm Password: </span></label>
              <input type="text" name="ConPassword" id="ConPassword" placeholder="Enter confirm password" class="form-control">
            </div>
            <div class="form-group">
              <div class="g-recaptcha" class="form-control mb-3" data-sitekey="6LfibhUeAAAAAAyhkFyogXIWkmmb6ItfIFZl25aL"></div>
            </div>
            <div class="row">
              <div class="col-lg-6 mb-2">
                <a href="Dashboard.php" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i> Back To Dashboard</a>
              </div>

              <div class="col-lg-6 mb-2">
                <button type="submit" name="Submit" class="btn btn-success btn-block">
                  <i class="fas fa-check"></i> Submit Now
                </button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>

    <!-- End Main Area -->
    <?php include("./inc/footer.php");?>