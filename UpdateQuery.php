<?php 
include('./includes/Functions.php');
include('./includes/Session.php');
?>

<?php
$id=$_GET['id'];
echo $id;
if(isset($_POST['save'])){
    $Post_Title = $_POST["PostTitle"];
    $Post_Category  = $_POST["Category"];
    $Post_Image     = $_FILES["Image"]["name"];
    $Target    = "Uploads/".basename($_FILES["Image"]["name"]);
    move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);
    $Post_Description  = $_POST["PostDescription"];

    $sql="UPDATE `post` SET `title` = '$Post_Title', `category` = '$Post_Category', `image` = '$Post_Image', `post` = '$Post_Description' WHERE `id` = $id";
  
   global $ConnectingDB;
   $Execute=$ConnectingDB->query($sql);
   if($Execute){
    $_SESSION["SuccessMessage"]="Update  Successfully";
    Redirect_to("Postdata.php");
    }else {
    $_SESSION["ErrorMessage"]= "Something went wrong. Try Again to delete !";
    Redirect_to("Postdata.php");

}

}
?>