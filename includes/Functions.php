<?php 
   require_once('DB.php');
   
   // for give the location to redirect another page
   function Redirect_to($new_location){
       header('Location:'.$new_location);
       exit;
   }

//    method to check user how many time trying to login
   function login_Attempt($UserName,$Password){
       global $ConnectingDB;
       $sql = "SELECT * FROM `admins` WHERE `username` = :username AND `password` = :password LIMIT 1";
       $stmt = $ConnectingDB->prepare($sql);
       $stmt->bindValue(':username',$UserName);
       $stmt->bindValue(':password',$Password);
       $stmt->execute();
       $result = $stmt->rowCount();    
      if($result == 1){
          return $stmt->fetch();
      }else{
          return null;
      }
   }

   //CheckIfuserExistOrNot
   function CheckUserNameExistsOrNot($UserName){
       global $ConnectingDB;
       $sql ="SELECT username FROM admins WHERE username =:UserName";
       $stmt =$ConnectingDB->prepare($sql);
       $stmt->bindValue(':UserName',$UserName);
       $stmt->execute();
       $result =$stmt->rowcount();
       if($result ==1){
           return true;
       }else{
           return false;
       }
   }
//    method to check if you are not login
   function confirm_login(){
       if(!isset($_SESSION['UserId'])){
           Redirect_to("login.php");
       }
   }
//  method if you are login then go to dashboard
   function already_login(){
       if(isset($_SESSION['UserId'])){
         Redirect_to("Dashboard.php"); 
       }
   }

// method to find all posts from post table 
    function TotalPosts(){
    global $ConnectingDB;
    $sql = "SELECT COUNT(*) FROM post";
    $Execute = $ConnectingDB->query($sql);
    $TotalRow1 = $Execute->fetch();
    $TotalPosts= array_shift($TotalRow1);
    echo $TotalPosts;
   }

// method to find all category from category table 
   function TotalCotegories(){
    global $ConnectingDB;
    $sql = "SELECT COUNT(*) FROM category";
    $Execute = $ConnectingDB->query($sql);
    $TotalRow2 = $Execute->fetch();
    $TotalCategory= array_shift($TotalRow2);
    echo $TotalCategory;

   }

// method to find all admins from admins table 
   function TotalAdmins(){
    global $ConnectingDB;
    $sql = "SELECT COUNT(*) FROM admins";
    $Execute = $ConnectingDB->query($sql);
    $TotalRow3 = $Execute->fetch();
    $TotalAdmins= array_shift($TotalRow3);
    echo $TotalAdmins;
   }

// method to find all comments from comments table 
   function TotalComments(){
    global $ConnectingDB;
    $sql = "SELECT COUNT(*) FROM comments";
    $Execute = $ConnectingDB->query($sql);
    $TotalRow4 = $Execute->fetch();
    $TotalComments= array_shift($TotalRow4);
    echo $TotalComments;
   }

// method to find all approveComment from comments table 
   function ApproveComments(){
       global $ConnectingDB;
       $sql ="SELECT COUNT(*) FROM comments where AproveComment=1";
       $Execute =$ConnectingDB->query($sql);
       $TotalRow5 = $Execute->fetch();
       $TotalApprove  =array_shift($TotalRow5);
       echo $TotalApprove;
   }

// method to find all disapproveComments from comments table 
    function UnApproveComments(){
       global $ConnectingDB;
       $sql =" SELECT COUNT(*) FROM comments where AproveComment=0";
       $Execute =$ConnectingDB->query($sql);
       $TotalRow6 =$Execute->fetch();
       $TotalUnApprove =array_shift($TotalRow6);
       echo $TotalUnApprove;
   }
   
?>