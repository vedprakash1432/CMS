<?php 
include('./includes/Functions.php');
include('./includes/Session.php');
?>
<?php Confirm_Login(); ?>
<?php
// if(isset($_POST["Submit"])){
  // $Post_Title = $_POST["PostTitle"];
  // $Post_Category  = $_POST["Category"];  $Post_Author   =$_POST['author'];  $Post_Image     = $_FILES["Image"]["name"];  $Target    = "Uploads/".basename($_FILES["Image"]["name"]);  $Post_Description  = $_POST["PostDescription"];  //$Post_Admin = "Ved";  date_default_timezone_set("Asia/Kolkata");  $CurrentTime=time();  $Post_DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);  if(empty($Post_Title)){    $_SESSION["ErrorMessage"]= "Title Cant be empty";    Redirect_to("AddNewPost.php");  }elseif (strlen($Post_Title)<5) {    $_SESSION["ErrorMessage"]= "Post Title should be greater than 5 characters";    Redirect_to("AddNewPost.php");  }elseif (strlen($Post_Description)>9999) {    $_SESSION["ErrorMessage"]= "Post Description should be less than than 1000 characters";    Redirect_to("AddNewPost.php");  }else{      $Post_id =$_GET['id'];    // Query to insert Post in DB When everything is fine    global $ConnectingDB;    $sql = "UPDATE FROM post2 set datetime=:dateTime,title=:postTitle,category=:categoryName,auther=:adminName,image=:imageName,post=:postDescription where id=$Post_id";    $stmt = $ConnectingDB->prepare($sql);    $stmt->bindValue(':dateTime',$Post_DateTime);    $stmt->bindValue(':postTitle',$Post_Title);    $stmt->bindValue(':categoryName',$Post_Category);    $stmt->bindValue(':adminName',$Post_Author);    $stmt->bindValue(':imageName',$Post_Image);    $stmt->bindValue(':postDescription',$Post_Description);    $Execute=$stmt->execute();    move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);    if($Execute){      $_SESSION["SuccessMessage"]="Post with id : " .$ConnectingDB->lastInsertId()." Updated Successfully";      Redirect_to("PostData.php");    }else {      $_SESSION["ErrorMessage"]= "Something went wrong. Try Again !";      Redirect_to("PostData.php");    }  }} 
 ?>
<?php include("./inc/header.php");?>

  
<section class="container py-2 mb-4">
  <div class="row">
    <div class="offset-lg-1 col-lg-10">
    <header class="bg-dark text-white py-3">
     <div class="container">
      <div class="row">
        <div class="col-md-12">
        <h2><i class="fas fa-edit text-warning "></i> Upadate Your Post</h2>
        </div>
      </div>
    </div>
   </header>
    
       <?php 
         $Post_id =$_GET['id'];
         global  $ConnectingDB;
         $sql ="SELECT * FROM post where id=$Post_id";
         $Execute =$ConnectingDB->query($sql);
         while ($DataRows=$Execute->fetch()) {
         $PostId = $DataRows["id"];
         $Post_Title =$DataRows['title'];
         $Post_Category =$DataRows['category'];
         $Auther = $DataRows["author"];
         $Image = $DataRows["image"];
         $DateTime = $DataRows["datetime"];
         $Post  = $DataRows['post'];
        ?>
        <?php } ?>
      <form class="" action="UpdateQuery.php?id=<?php echo $PostId; ?>" method="post" enctype="multipart/form-data">
        <div class="card bg-secondary text-light mb-3">
          <div class="card-body bg-dark">
            <div class="form-group">
              <label for="title"> <span class="FieldInfo">Update Post Title: </span></label>
               <input class="form-control" type="text" name="PostTitle" id="title" value="<?php echo $Post_Title; ?>">
            </div>
            <div class="form-group">
               <label for="CategoryTitle"> <span class="FieldInfo"> Choose Categroy: </span></label>
               <select class="form-control" id="CategoryTitle"  name="Category">
                  <option> <?php echo $Post_Category; ?></option>
               </select>
            </div>
            <div class="form-group">
              <div class="custom-file">
                <label for="imageSelect" class="custom-file-label">Select Image </label>
               <input class="custom-file-input" type="File" name="Image" id="imageSelect" value="">
              </div>
            </div>
            <div class="form-group">
              <label for="Post"> <span class="FieldInfo"> Post Update: </span></label>
              <textarea class="form-control" id="Post" name="PostDescription" rows="8" cols="80"><?php echo $Post;?></textarea>
            </div>
            <div class="row">
              <div class="col-lg-6 mb-2">
                <a href="Dashboard.php" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i> Back To Dashboard</a>
              </div>
              <div class="col-lg-6 mb-2">
              <input type="submit" name="save" class="btn btn-success btn-block " value="Update now!!">                        
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>
    <!-- End Main Area -->
 

 
