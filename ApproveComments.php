<?php 
include('./includes/Functions.php');
include('./includes/Session.php');
?>  
<?php confirm_login();?>
<?php
if(isset($_GET['id'])){
    $id =$_GET['id'];
    global $ConnectingDB;
    $sql = "DELETE FROM `comments` WHERE id=:ID";
    $stmt = $ConnectingDB->prepare($sql);
    $stmt->bindValue(':ID',$id);
    $Execute=$stmt->execute();
    if($Execute){
    $_SESSION["SuccessMessage"]="Comment Deleted Successfully";
    Redirect_to("ApproveComments.php");
    }else {
    $_SESSION["ErrorMessage"]= "Something went wrong. Try Again to delete !";
    Redirect_to("ApproveComments.php");
  }

}
?>

<?php include("./inc/header.php");?>
<?php include("./inc/navbar.php");?>
  
       <div class="container">
       <div class="row mb-3">
          <div class="col-lg-12 col-md-10 col-sm-8 bg-light">
              <h2>Un-Approve Comments</h2>
              <div class="row">
               <div class="col-lg-12">
                   <form action="" method="post">
                <table class="table table-striped table-hover">
                  <thead class="thead-dark">
                    <tr>
                      <th>SrNo</th>
                      <th>Datetime</th>
                      <th>Name</th>                   
                      <th>Comments</th>
                      <th>Approve</th>
                      <th>Action</th>
                      <th>Details</th>
                    </tr>
                  </thead>
                  <?php
                   global $ConnectingDB;
                  //  $sql = "SELECT * FROM comments right join post2 on comments.id = post2.id where AproveComment=0";
                   $sql = "SELECT * FROM comments  where AproveComment=0";
                   $Execute =$ConnectingDB->query($sql);
                   $SrNo = 0;
                   while ($DataRows=$Execute->fetch()) {
                     $AdminId =$DataRows['id'];
                    $id=$DataRows['id'];
                    $datetime=$DataRows['DateTime'];
                    $name=$DataRows['Name'];
                    $comments=$DataRows['Comments'];
                   $SrNo++;
                   ?>
                  <tbody>
                   <tr class="table-secondry">
                    <td><?php echo htmlentities($SrNo); ?></td>
                    <td><?php echo $datetime; ?></td>
                    <td><?php echo htmlentities($name); ?></td>                    
                    <td><?php echo $comments; ?></td>
                    <td><a href="Aprove.php? id=<?php echo $id;?>" class="form-control btn btn-success">Approve</a></td>
                    <td><a href="ApproveComments.php?id=<?php echo $id;?>" onclick="return confirm('Are you sure! Do you want to delete this item?');" class="btn btn-danger">Delete</a>  </td>                   
                    <td><a href="fullpost.php?id=<?php echo $AdminId;?>" target="_blank"><span class="btn btn-info">Live Preview</span></a></td>
                  </tr>
                  </tbody>
                 <?php } ?>
                </table>
                </form>
               </div>
             </div>
             
             <h2>Approve Comments</h2>
              <div class="row">
               <div class="col-lg-12">
                   <form action="" method="post">
                <table class="table table-striped table-hover">
                  <thead class="thead-dark">
                    <tr>
                      <th>SrNo</th>
                      <th>Datetime</th>
                      <th>Name</th>                   
                      <th>Comments</th>
                      <th>Approve By</th>
                      <th>Revert</th>
                      <th>Action</th>
                      <th>Details</th>
                    </tr>
                  </thead>
                  <?php
                   global $ConnectingDB;
                  //  $sql = "SELECT * FROM post2 right join comments on post2.id= comments.id where AproveComment=1 ";
                   $sql = "SELECT * FROM comments where AproveComment=1";
                   $Execute =$ConnectingDB->query($sql);
                   $SrNo = 0;
                   while ($DataRows=$Execute->fetch()) {
                    $AdminId = $DataRows['id'];
                    $id=$DataRows['id'];
                    $datetime=$DataRows['DateTime'];
                    $name=$DataRows['Name'];
                    $comments=$DataRows['Comments'];
                   $SrNo++;
                   ?>
                  <tbody>
                   <tr class="table-secondry">
                    <td><?php echo htmlentities($SrNo); ?></td>
                    <td><?php echo $datetime; ?></td>
                    <td><?php echo htmlentities($name); ?></td>                    
                    <td><?php echo $comments; ?></td>
                    <td><?php echo htmlentities($name); ?></td>                    
                    <td><a href="Un-Approve.php? id=<?php echo $id;?>" class="form-control btn btn-success">Un-Approve</a></td>
                    <td><a href="ApproveComments.php?id=<?php echo $id;?>" onclick="return confirm('Are you sure! Do you want to delete this item?');" class="btn btn-danger">Delete</a>  </td>                   
                    <td><a href="fullpost.php?id=<?php echo $AdminId;?>" target="_blank"><span class="btn btn-info">Live Preview</span></a></td>
                  </tr>
                  </tbody>
                 <?php } ?>
                </table>
                </form>
               </div>
             </div>
          </div>
            
        </div>
       </div>

    <?php include("./inc/footer.php");?>
