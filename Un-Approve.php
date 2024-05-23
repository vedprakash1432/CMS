<?php 
include('./includes/Functions.php');
include('./includes/Session.php');
?>  

<?php
if(isset($_GET['id'])){
    $id =$_GET['id'];

    global $ConnectingDB;

    $sql ="UPDATE comments set AproveComment = 0 where id=$id";
    $result = $ConnectingDB->query($sql);
    if($result){
        Redirect_to("ApproveComments.php");
    }else{
        echo "something is wrong!!";
    }
}
?>