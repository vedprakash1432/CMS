<?php 
include('./includes/Functions.php');
include('./includes/Session.php');
?>
<?php
  $UserId = $_SESSION['UserId'];
  if(isset($_POST['save'])){
      $AdminName = $_POST['name'];
    //   $Image     =$_POST['Image'];
      $AdminBio  =$_POST['Bio'];
   
  $sql ="UPDATE admins SET aname='$AdminName',AdminBio='$AdminBio' WHERE id=$UserId";
  global $connectingDB;
  $Execute =$connectingDB->query($sql);
  if($Execute){
    $_SESSION["SuccessMessage"]="Profile Update Successfully";
    Redirect_to("MyProfile.php");
    }else {
    $_SESSION["ErrorMessage"]= "Something went wrong. Try Again to Update !";
    Redirect_to("MyProfile.php");

  }
}

?>