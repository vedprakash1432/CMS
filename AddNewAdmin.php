<?php require_once("includes/Functions.php"); ?>
<?php require_once("includes/Session.php"); ?>

<!-- deleting admin items form admins table in database start here -->
<?php if(isset($_GET['id'])){
    $id =$_GET['id'];

    global $ConnectingDB;
    $sql = "DELETE FROM `admins` WHERE id=:ID";
    $stmt = $ConnectingDB->prepare($sql);
    $stmt->bindValue(':ID',$id);
    $Execute=$stmt->execute();
    if($Execute){
    $_SESSION["SuccessMessage"] ="Admin Deleted Successfully";
    Redirect_to("AddNewAdmin.php");
    }else {
    $_SESSION["ErrorMessage"] = "Something went wrong. Try Again to delete !";
    Redirect_to("AddNewAdmin.php");
  }
}
?>
<!-- delete admin code end -->

<!-- inserting or adding new admin data in database -->
<?php Confirm_Login(); ?>
<?php
if(isset($_POST["Submit"])){
  $Admin_UserName        = $_POST["Username"];
  $Admin_Name            = $_POST["Name"];
  $Admin_Password        = $_POST["Password"];
  $Admin_ConfirmPassword = $_POST["ConfirmPassword"];
  $Admin_Bio             =$_POST['Bio'];
  $Admin_Image           = $_FILES["Image"]["name"];
  $Target                = "uploads/".basename($_FILES["Image"]["name"]);
  $AddedBy               =$_SESSION['AdminName'];

  // echo $AddedBy;
  move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);


  date_default_timezone_set("Asia/Kolkata");
  $CurrentTime=time();
  $Admin_DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
  
  // admin userName and admin password empty validation 
  if(empty($Admin_UserName)||empty($Admin_Password)){
    $_SESSION["ErrorMessage"]= "All fields must be filled out";
    Redirect_to("AddNewAdmin.php");
  }elseif (strlen($Admin_Password)<4) {
    $_SESSION["ErrorMessage"]= "Password should be greater than 3 characters";
    Redirect_to("AddNewAdmin.php");
  }elseif ($Admin_Password != $Admin_ConfirmPassword) {
    $_SESSION["ErrorMessage"]= "Password and Confirm Password should match";
    Redirect_to("AddNewAdmin.php");
  }elseif (CheckUserNameExistsOrNot($Admin_UserName)) {
    $_SESSION["ErrorMessage"]= "Username Exists. Try Another One! ";
    Redirect_to("AddNewAdmin.php");
  }else{
    // Query to insert new admin in DB When everything is fine
    global $ConnectingDB;
    $sql = "INSERT INTO admins(datetime,username,password,aname,AdminImage,AdminBio,AddedBy)";
    $sql .= "VALUES(:dateTime,:userName,:password,:aName,:adminImage,:adminBio,:AddedBy)";
    $stmt = $ConnectingDB->prepare($sql);
    $stmt->bindValue(':dateTime',$Admin_DateTime);
    $stmt->bindValue(':userName',$Admin_UserName);
    $stmt->bindValue(':password',$Admin_Password);
    $stmt->bindValue(':aName',$Admin_Name);
    $stmt->bindValue(':adminImage',$Admin_Image);
    $stmt->bindValue(':adminBio',$Admin_Bio);
    $stmt->bindValue(':AddedBy',$AddedBy);

    //$stmt->bindValue(':adminName',$Admin);
    $Execute=$stmt->execute();
    if($Execute){
      $_SESSION["SuccessMessage"]="New Admin with the name of ".$Admin_Name." added Successfully";
      Redirect_to("AddNewAdmin.php");
    }else {
      $_SESSION["ErrorMessage"]= "Something went wrong. Try Again !";
      Redirect_to("AddNewAdmin.php");
    }
  }
} //Ending of Submit Button If-Condition
?>
<?php include("./inc/header.php");?>
<?php include("./inc/navbar.php");?>
    <!-- HEADER -->
    <header class="bg-dark text-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
           <h1><i class="fas fa-user text-warning"></i> Manage Admins</h1>
          </div>
        </div>
      </div>
    </header>
    <!-- HEADER END -->
     <!-- Main Area -->
<section class="container py-2 mb-4">
    <?php
       echo ErrorMessage();
       echo SuccessMessage();
    ?>
  <div class="row">
    <div class="offset-lg-1 col-lg-10">
      <form class="" action="" method="POST" enctype="multipart/form-data">
        <div class="card bg-dark text-light mb-3">
          <div class="card-header">
            <h2><i class="fas fa-plus text-warning"></i> Add New Admin</h2>
          </div>
          <div class="card-body bg-dark text-light">
            <div class="form-group">
              <label for="username"> <span class="FieldInfo"> Username: </span></label>
               <input class="form-control" type="text" name="Username" id="username"  value="">
            </div>
            <div class="form-group">
              <label for="Name"> <span class="FieldInfo"> Name: </span></label>
               <input class="form-control" type="text" name="Name" id="Name" value="">
               <small class="text-muted">*Optional</small>
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
              <label for="Password"> <span class="FieldInfo"> Password: </span></label>
               <input class="form-control" type="password" name="Password" id="Password" value="">
            </div>
            <div class="form-group">
              <label for="ConfirmPassword"> <span class="FieldInfo"> Confirm Password:</span></label>
               <input class="form-control" type="password" name="ConfirmPassword" id="ConfirmPassword"  value="">
            </div>
            <div class="row">
              <div class="col-lg-6 mb-2">
                <a href="Dashboard.php" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i> Back To Dashboard</a>
              </div>
              <div class="col-lg-6 mb-2">
                <button type="submit" name="Submit" class="btn btn-success btn-block">
                  <i class="fas fa-check"></i> Publish
                </button>
              </div>
            </div>
          </div>
        </div>
      </form>
      <table class="table table-striped table-active table-hover">
        <h2>Existing Admins</h2>
        <thead class="thead-dark">
          <tr>
            <th>No. </th>
            <th>Date&Time</th>
            <th>Username</th>
            <th>Admin Name</th>
            <th>Added by</th>
            <th>Action</th>
          </tr>
        </thead>
      <?php
      global $ConnectingDB;
      $sql = "SELECT * FROM admins ORDER BY id desc";
      $Execute =$ConnectingDB->query($sql);
      
      $SrNo = 0;
      while ($DataRows=$Execute->fetch()) {
        // print_r($DataRows);die;
        $AdminId = $DataRows["id"];
        $Admin_DateTime = $DataRows["datetime"];
        $Admin_UserName = $DataRows["username"];
        $Admin_Name= $DataRows["aname"];
        $AddedBy     = $DataRows["AddedBy"];
        $SrNo++;
      ?>
      <tbody>
        <tr>
          <td><?php echo htmlentities($SrNo); ?></td>
          <td><?php echo htmlentities($Admin_DateTime); ?></td>
          <td><?php echo htmlentities($Admin_UserName); ?></td>
          <td><?php echo htmlentities($Admin_Name); ?></td>
          <td><?php echo htmlentities($AddedBy); ?></td>
          <td> <a href="AddNewAdmin.php?id=<?php echo $AdminId;?>" onclick="return confirm('Are you sure! Do you want to delete this item?');" class="btn btn-danger">Delete</a>  </td>
      </tr>    
      </tbody>
      <?php } ?>
      </table>
    </div>
  </div>
</section>
<?php include("./inc/footer.php");?>