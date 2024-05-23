<?php 
include('./includes/Functions.php');
include('./includes/Session.php');
?>
<!-- deleting category items form category table in database start here -->
<?php
if(isset($_GET['id'])){
    $id =$_GET['id'];
}
global $ConnectingDB;
$sql = "DELETE FROM `category` WHERE id=:ID";
$stmt = $ConnectingDB->prepare($sql);
$stmt->bindValue(':ID',$id);
$Execute=$stmt->execute();
if($Execute){
    $_SESSION["SuccessMessage"]="Cotegory Deleted Successfully";
    Redirect_to("category.php");
  }else {
    $_SESSION["ErrorMessage"]= "Something went wrong. Try Again to delete !";
    Redirect_to("category.php");
  }
?>