<?php 
include('./includes/Functions.php');
include('./includes/Session.php');
?>
<!-- deleting admin items form admins table in database start here -->
<?php
if(isset($_GET['id'])){
    $id =$_GET['id'];
}
global $ConnectingDB;
$sql = "DELETE FROM `admins` WHERE id=:ID";
$stmt = $ConnectingDB->prepare($sql);
$stmt->bindValue(':ID',$id);
$Execute=$stmt->execute();
if($Execute){
    $_SESSION["SuccessMessage"]="Admin Deleted Successfully";
    Redirect_to("AddNewAdmin.php");
  }else {
    $_SESSION["ErrorMessage"]= "Something went wrong. Try Again to delete !";
    Redirect_to("AddNewAdmin.php");
  }
?>