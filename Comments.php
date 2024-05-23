
<?php 
include('./includes/Functions.php');
// include('./includes/function.php');
include('./includes/Session.php');
?>

<?php confirm_login();?>

<?php
if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $comments=$_POST['comments'];
    date_default_timezone_set("Asia/Kolkata");
  $CurrentTime=time();
  $Cotegory_DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);

   // echo $email;
    $sql="INSERT INTO `comments` ( `name`, `email`, `comments`, `datetime`) VALUES ( '$name', '$email', '$comments', ' $Cotegory_DateTime')";
    global $ConnectingDB;

    $stmt= $ConnectingDB->prepare($sql);
    $execute=$stmt->execute();
    if($execute){
        echo "done";

    }else{
        echo "something went wrong";
    }

}
?>