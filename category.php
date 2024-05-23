<?php 
include('./includes/Functions.php');
include('./includes/Session.php');
?>
<!-- deleting category items form category table in database start here -->
<?php Confirm_Login(); ?>
<?php
if(isset($_GET['id'])){
    $id =$_GET['id'];
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
}
?>
<?php
if(isset($_POST["Submit"])){
  $Category_Title = $_POST["CategoryTitle"];
  $Category_Admin = "vedprakash";
  date_default_timezone_set("Asia/Kolkata");
  $CurrentTime=time();
  $Cotegory_DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);

  if(empty($Category_Title)){
    $_SESSION["ErrorMessage"]= "All fields must be filled out";
    Redirect_to("category.php");
  }elseif (strlen($Category_Title)<3) {
    $_SESSION["ErrorMessage"]= "Category title should be greater than 2 characters";
    Redirect_to("category.php");
  }elseif (strlen($Category_Title)>49) {
    $_SESSION["ErrorMessage"]= "Category title should be less than than 50 characters";
    Redirect_to("category.php");
  }else{
    // Query to insert category in DB When everything is fine
    global $ConnectingDB;
    $sql = "INSERT INTO category(category,author,datetime)";
    $sql .= "VALUES(:categoryName,:adminName,:dateTime)";
    $stmt = $ConnectingDB->prepare($sql);
    $stmt->bindValue(':categoryName',$Category_Title);
    $stmt->bindValue(':adminName',$Category_Admin);
    $stmt->bindValue(':dateTime',$Cotegory_DateTime);
    $Execute=$stmt->execute();

    if($Execute){
      $_SESSION["SuccessMessage"]="Category with id : " .$ConnectingDB->lastInsertId()." added Successfully";
      Redirect_to("category.php");
    }else {
      $_SESSION["ErrorMessage"]= "Something went wrong. Try Again !";
      Redirect_to("category.php");
    }
  }
}
?>
<?php include("./inc/header.php");?>
<?php include("./inc/navbar.php");?>

<!-- Header Starts -->
    <header class="bg-dark text-white py-3">
       <div class="container">
           <div class="row">
               <div class="col-md-12">
                   <h1><i class="fas fa-edit" style="color:#27aae1;"></i>Manage Categories</h1>
               </div>
           </div>
       </div>
    </header>
<!--Header Ends    -->
    
    <!-- Main Area    -->
     <section class="container py-2 my-4">
          <div class="row">
              <div class="offset-lg-1 col-lg-10" >
                  <?php
                   echo ErrorMessage();
                   echo SuccessMessage();
                  ?>
                  <form action="" method="post">
                      <div class="card bg-secondary text-white mb-3">
                          <div class="card-header">
                              <h3><i class="fas fa-plus text-warning "></i> Add New Category</h3>
                          </div>
                          <div class="card-body bg-dark">
                          <div class="form-group">
                              <label for=""><Span>Category Title:</Span></label>
                              <input class="form-control" type="text" name="CategoryTitle" id="title" placeholder="Type title here" value=""/>
                          </div>
                          <div class="row">
                              <div class="col-lg-6 mb-2">
                                  <a href="dashboard.php" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i>Back To Dashboard</a>
                              </div>
                              <div class="col-lg-6 mb-2">
                                   <button type="submit" name="Submit" class="btn btn-success btn-block">
                                       <i class="fas fa-check"></i>Publish
                                   </button> 
                              </div>
                          </div> 
                      </div>
                    </div>
               </form>
                
    <h2>Existing Categories</h2>
    <table class="table table-striped table-hover">
        <thead class="thead-dark">
          <tr>
            <th>No. </th>
            <th>Date&Time</th>
            <th>Categories</th>
            <th>Author</th>
            <th>Action</th>
          </tr>
        </thead>
      <?php
      global $ConnectingDB;
      $sql = "SELECT * FROM category ORDER BY id desc";
      $Execute =$ConnectingDB->query($sql);
      $SrNo = 0;
      while ($DataRows=$Execute->fetch()) {
        $AdminId = $DataRows["id"];
        $Category_DateTime = $DataRows["datetime"];
        $Category_Title =$DataRows['category'];
        $Category_Auther = $DataRows["author"];
        $SrNo++;
      ?>
      <tbody>
        <tr>
          <td><?php echo htmlentities($SrNo); ?></td>
          <td><?php echo htmlentities($Category_DateTime); ?></td>
          <td><?php echo htmlentities($Category_Title); ?></td>
          <td><?php echo htmlentities($Category_Auther); ?></td>
          <td> <a href="category.php?id=<?php echo $AdminId;?>" onclick="return confirm('Are you sure! Do you want to delete this item?');" class="btn btn-danger">Delete</a>  </td>
      </tr>
      </tbody>
      <?php } ?>
      </table>
             </div>
        </div>
   </section>    
   <?php include("./inc/footer.php");?>