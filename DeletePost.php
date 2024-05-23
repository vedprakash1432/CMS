<?php 
include('./includes/Functions.php');
include('./includes/Session.php');
?>
<!-- deleting Post items form post2 table in database start here -->
<?php
if(isset($_GET['id'])){
    $Post_id =$_GET['id'];
}
global $ConnectingDB;
$sql = "DELETE FROM `post` WHERE id=:ID";
$stmt = $ConnectingDB->prepare($sql);
$stmt->bindValue(':ID',$Post_id);
$Execute=$stmt->execute();
if($Execute){
    $_SESSION["SuccessMessage"]="Post Deleted Successfully";
    Redirect_to("PostData.php");
  }else {
    $_SESSION["ErrorMessage"]= "Something went wrong. Try Again to delete !";
    Redirect_to("PostData.php");
  }
?>