<?php 
include('./includes/Functions.php');
include('./includes/Session.php');
?>
<!-- deleting Post items form post2 table in database start here -->
<?php Confirm_Login(); ?>
<?php
if(isset($_GET['id'])){
    $id =$_GET['id'];
    global $ConnectingDB;
    $sql = "DELETE FROM `post` WHERE id=:ID";
    $stmt = $ConnectingDB->prepare($sql);
    $stmt->bindValue(':ID',$id);
    $Execute=$stmt->execute();
    if($Execute){
    $_SESSION["SuccessMessage"]="Post Deleted Successfully";
    Redirect_to("AddNewPost.php");
    }else {
    $_SESSION["ErrorMessage"]= "Something went wrong. Try Again to delete !";
    Redirect_to("AddNewPost.php");
  }
}
?>

<?php
if(isset($_POST["Submit"])){
  $Post_Title = $_POST["PostTitle"];
  $Post_Category  = $_POST["Category"];
  $Post_Author   =$_POST['author'];
  $Post_Image     = $_FILES["Image"]["name"];
  $Target    = "Uploads/".basename($_FILES["Image"]["name"]);
  $Post_Description  = $_POST["PostDescription"];
  $Post_Admin = "Ved";
  date_default_timezone_set("Asia/Kolkata");
  $CurrentTime=time();
  $Post_DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);

  if(empty($Post_Title)){
    $_SESSION["ErrorMessage"]= "Title Cant be empty";
    Redirect_to("AddNewPost.php");
  }elseif (strlen($Post_Title)<5) {
    $_SESSION["ErrorMessage"]= "Post Title should be greater than 5 characters";
    Redirect_to("AddNewPost.php");
  }elseif (strlen($Post_Description)>9999) {
    $_SESSION["ErrorMessage"]= "Post Description should be less than than 1000 characters";
    Redirect_to("AddNewPost.php");
  }else{
    // Query to insert Post in DB When everything is fine
    global $ConnectingDB;
    $sql = "INSERT INTO post(datetime,title,category,author,image,post)";
    $sql .= "VALUES(:dateTime,:postTitle,:categoryName,:adminName,:imageName,:postDescription)";
    $stmt = $ConnectingDB->prepare($sql);
    $stmt->bindValue(':dateTime',$Post_DateTime);
    $stmt->bindValue(':postTitle',$Post_Title);
    $stmt->bindValue(':categoryName',$Post_Category);
    $stmt->bindValue(':adminName',$Post_Admin);
    $stmt->bindValue(':imageName',$Post_Image);
    $stmt->bindValue(':postDescription',$Post_Description);
    $Execute=$stmt->execute();
    move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);
    if($Execute){
      $_SESSION["SuccessMessage"]="Post with id : " .$ConnectingDB->lastInsertId()." added Successfully";
      Redirect_to("AddNewPost.php");
    }else {
      $_SESSION["ErrorMessage"]= "Something went wrong. Try Again !";
      Redirect_to("AddNewPost.php");
    }
  }
} 
 ?>
<?php include("./inc/header.php");?>
<?php include("./inc/navbar.php");?>
  
    <header class="bg-dark text-white py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
          <h2><i class="fas fa-plus text-warning "></i> Add New Post</h2>
          </div>
        </div>
      </div>
    </header>
<section class="container py-2 mb-4">
  <div class="row">
    <div class="offset-lg-1 col-lg-10">
      <?php
       echo ErrorMessage();
       echo SuccessMessage();
       ?>
      <form class="" action="AddNewPost.php" method="post" enctype="multipart/form-data">
        <div class="card bg-secondary text-light mb-3">
          <div class="card-body bg-dark">
            <div class="form-group">
              <label for="title"> <span class="FieldInfo"> Post Title: </span></label>
               <input class="form-control" type="text" name="PostTitle" id="title" placeholder="Type title here" value="">
            </div>
            <div class="form-group">
              <label for="CategoryTitle"> <span class="FieldInfo"> Choose Categroy </span></label>
               <select class="form-control" id="CategoryTitle"  name="Category">
                 <?php
                 global $ConnectingDB;
                 $sql = "SELECT id,category FROM category";
                 $stmt = $ConnectingDB->query($sql);
                 while ($DataRows = $stmt->fetch()) {
                   $Category_Id = $DataRows["id"];
                   $Category_Title = $DataRows["category"];
                  ?>
                  <option> <?php echo $Category_Title; ?></option>
                  <?php } ?>
               </select>
            </div>
            
            <div class="form-group">
              <div class="custom-file">
              <input class="custom-file-input" type="File" name="Image" id="imageSelect" value="">
              <label for="imageSelect" class="custom-file-label">Select Image </label>
              </div>
            </div>
           <div class="form-group">
           <label for="Post"> <span class="FieldInfo"> Post: </span></label>
           <textarea class="form-control" id="Post" name="PostDescription" rows="8" cols="80"></textarea>
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

      <h2>Existing Posts</h2>
    <table class="table table-striped  table-active table-hover">
        <thead class="thead-dark">
          <tr>
            <th>No. </th>
            <th>Date&Time</th>
            <th>Categories</th>
            <th>Author</th>
            <th>Images</th>
            <th>Post description</th>
            <th>Action</th>
          </tr>
        </thead>
      <?php
      global $ConnectingDB;
      $sql = "SELECT * FROM post ORDER BY id desc";
      $Execute =$ConnectingDB->query($sql);
      $SrNo = 0;
      while ($DataRows=$Execute->fetch()) {
        $AdminId = $DataRows["id"];
        $Post_DateTime = $DataRows["datetime"];
        $Post_Title =$DataRows['category'];
        $Post_Author = $DataRows["author"];
        $Post_Image   = $DataRows['image'];
        $Post_Description  = $DataRows['post'];
        $SrNo++;
      ?>
      <tbody>
        <tr>
          <td><?php echo htmlentities($SrNo); ?></td>
          <td><?php echo htmlentities($Post_DateTime); ?></td>
          <td><?php echo htmlentities($Post_Title); ?></td>
          <td><?php echo htmlentities($Post_Author); ?></td>
          <td><?php echo '<img src="./uploads/'.$Post_Image.'" class="" alt="" style="width:90px; height:60px">' ?></td>
          <td><?php echo substr($Post_Description,0, 30)?></td>
          <td> <a href="AddNewPost.php?id=<?php echo $AdminId;?>" onclick="return confirm('Are you sure! Do you want to delete this item?');" class="btn btn-danger">Delete</a>  </td>
      </tr>
      </tbody>
      <?php } ?>
      </table>
    </div>
  </div>
</section>
    <!-- End Main Area -->
  <?php  include("./inc/footer.php");?>

 
