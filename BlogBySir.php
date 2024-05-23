<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>this is blog page</title>
    <style media="screen">
    .heading{
      font-family: Bittter,Georgia,"Times New Roman",Times,serif;
      font-weight: bold;
      color: #005E90;
    }
    .heading:hover{
      color:#0090DB;
    }
    </style>
</head>
<body>
<?php 
include('./includes/Functions.php');
include('./includes/Session.php');
?>  
<?php
include("./inc/header.php");
include("./inc/footer.php");
?>

    <!-- navbar start -->
<div style="height:10px; background:black;"></div>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a href="#" class="navbar-brand"> MICRONSOL.COM</a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarcollapseCMS">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a href="MyProfile.php" class="nav-link"> <i class="fas fa-user text-success"></i> My Profile</a>
        </li>
        <li class="nav-item">
          <a href="Dashboard.php" class="nav-link">Dashboard</a>
        </li>
        <li class="nav-item">
          <a href="AddNewPost.php" class="nav-link">Posts</a>
        </li>
        <li class="nav-item">
          <a href="category.php" class="nav-link">Categories</a>
        </li>
        <li class="nav-item">
          <a href="AddNewAdmin.php" class="nav-link">Manage Admins</a>
        </li>
        <li class="nav-item">
          <a href="Comments.php" class="nav-link">Comments</a>
        </li>
        <li class="nav-item">
          <a href="Blog.php?page=1" class="nav-link" target="_blank">Live Blog</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a href="logout.php" class="nav-link text-danger">
          <i class="fas fa-user-times"></i> Logout</a></li>
      </ul>
      </div>
    </div>
</nav>
<div style="height:10px; background:black;"></div>

<!-- header  search -->
<div class="container">
 <div class="row mt-4">
    <!-- Main area start  -->
    <div class="col-sm-8">
        <h1>Micronsol Blog</h1>
        <h2 class="lead">This is Blog Page of Micronsol </h2>
        <?php echo ErrorMessage(); 
             echo SuccessMessage(); 
        ?>
        <?php
          global $ConnectingDB;
          //sql query when search button is active
          if(isset($_GET['SearchButton'])){
              $Search = $_GET['Search'];
              $sql ="SELECT * FROM post2 WHERE datetime LIKE :search 
              OR title LIKE :search 
              OR category LIKE : search 
              OR post LIKE : search";
              $stmt = $ConnectingDB->prepare($sql);
              $stmt->bindValue(':search','%'.$Search.'%');
              $stmt->Execute();
          }
          elseif(isset($_GET['page'])){
              $Page =$_GET['page'];
              if($Page==0 || $Page<1){
                  $ShowPostForm = 0;
              }else{
                  $ShowPostForm = ($Page*5)-5;
              }
              $sql ="SELECT * FROM post2 ORDER BY id desc LIMIT $ShowPostForm,5";
              $stmt= $ConnectingDB->query($sql);

          }
          //query when category is active in URL Tab
          elseif(isset($_GET['category'])){
              $cotegory = $_GET['category'];
              $sql ="SELECT * FROM post2 WHERE category='$cotegory' ORDER BY id desc";
              $stmt =$ConnectingDB->query($sql);  
          }
          //the default SQL query
          else{
              $sql = "SELECT * FROM post2 ORDER BY id desc LIMIT 0,3";
              $stmt =$ConnectingDB->query($sql);
          }
          while($DataRow =$stmt->fetch()){
              $PostId  =$DataRow['id'];
              $DateTime =$DataRow['datetime'];
              $Post_Title =$DataRow['title'];
              $Category =$DataRow['category'];
              $Author =$DataRow['author'];
              $Image =$DataRow['image'];
              $DateTime =$DataRow['datetime'];
              $Post_Description =$DataRow['post'];
              
        ?> 
        <div class="card">
            <img src="uploads/<?php echo htmlentities($Image);?>" style="max-height:450px" class="img-fluid card-img-top" alt=""/>
            <div class="card-body">
                <h4 class="card-title"><?php echo htmlentities($Post_Title);?></h4>
                <small class="text-muted">Category: <Span class="text-dark"><a href="blog.php?category=<?php echo htmlentities($Category);?>"><?php echo htmlentities($Category);?> </a></Span>
                 $ Written by <span class="text-dark"><a href="Profile.php?Username=<?php echo htmlentities($Author);?>"><?php echo htmlentities($Author);?></a></span>
                on<span class="text-dark"><?php echo htmlentities($DateTime); ?></span></small>
                <span style="float:right;" class="badge badge-dark text-light"> comments:<?php echo AproveCommentsAccordingPost($PostId); ?></span><hr>
              <p class="card-text">
                  <?php if(strlen($Post_Description)>150){ $Post_Description = substr($Post_Description,0,150)."...";}
                  echo htmlentities($Post_Description);?>
              </p>
                <a href="fullPost.php?id=<?php echo $PostId;?>" style="float:right;"> <span class="btn btn-info">Read More</span>
               </a>
            </div>
        </div>
     <?php   } ?>
     
     <!-- pagonation  -->
     <nav>
       <ul class="pagination pagination-lg">
         <?php if(isset($Page)){
           if($Page>1){?>
           <li class="page-item">
             <a href="BlogBySir.php?page=<? echo $Page-1; ?>" class="page-link">&laquo;</a>
           </li>

           <?php } ?>
           <?php 
           global $ConnectingDB;
           $sql  ="SELECT COUNT(*) FROM post2";
           $stmt =$ConnectingDB->query($sql);
           $RowPagination =$stmt->fetch();
           $TotalPosts  =array_shift($RowPagination);
           // echo $TotalPosts."<br>";
           $PostPagination = $TotalPosts/5;
           $PostPagination= ceil($PostPagination);
           // echo $PostPagination;
           for ($i=1; $i <= $PostPagination; $i++){
             if(isset($Page)){
               if($i == $Page){ ?>
               <li class="page-item active">
                  <a href="BlogBySir.php?page=<?php echo $i; ?>" class="page-link"><?php echo $i;?></a>
               </li>
               <?php
              }else{
                ?> <li class="page-item">
                  <a href="BlogBySir.php?page=<?php echo $i; ?>" class="page-link"><?php echo $i;?></a>
                  </li>   
              <?php }    
             }
           }   
         }?>
         <!-- creating forward button -->
         <?php if(isset($page) && !empty($Page)){
           if($Page+1 <= $PostPagination) {?> 
           <li class="page-item">
             <a href="BlogBySir.php?page=<?php echo $Page+1;?>" class="page-link">&raquo;</a>
           </li> 
       <?php   }
         } ?>
       </ul>
     </nav>
    
    <!-- main area end -->
    <!-- side area start -->
    <div class="col-sm-4">
      <div class="card-mt-4">
        <div class="card-body">
          <img src="images/startblog.png" alt="" class="d-block img-fluid mb-3">
          <div class="text-center">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam ut magni suscipit laboriosam dolore dolorum, quis architecto, tempore quisquam inventore culpa assumenda fugiat voluptate cumque laudantium quia aut cum provident.
          </div>
        </div>
      </div>
    </div>
    <br>
    <div class="card">
      <div class="card-header bg-dark text-light">
        <h2 class="lead">SignUp!</h2>
      </div>
      <div class="card-body">
        <button class="btn btn-success btn-block text-center text-white mb-4" type="button" name="button">Join the form</button>
        <button class="btn btn-danger btn-block text-center text-white mb-4" type="button" name="button">Login</button>
        <div class="input-group mb-3">
         <input type="text" class="form-control" placeholder="Enter your email" value="">
          <div class="input-group-append">
            <button type="button" class="btn btn-primary btn-sm text-center text-white" name="button">Subscribe Now</button>
          </div>
        </div>
      </div>
    </div>
    <br>
    <div class="card">
      <div class="card-header bg-primary text-light">
        <h2 class="lead">Categories</h2>
      </div>
      <div class="card-body">
        <?php 
        global $ConnectingDB;
        $sql ="SELECT * FROM category ORDER BY id desc";
        $stmt =$ConnectingDB->query($sql);
        while($DataRow =$stmt->fetch()){
          $Category =$DataRow['id'];
          $CategoryName =$DataRow['title'];
          ?>
          <a href="BlogBySir.php?category=<?php echo $CategoryName; ?>"><span class="heading"><?php echo $Category; ?></span></a><br>
        <?php } ?>
      </div>
    </div>
    <br>
    <div class="card">
      <div class="card-header bg-info text-white">
       <h2 class="lead">Recent Posts</h2>
      </div>
      <div class="card-body">
        <?php
        global $ConnectingDB;
        $sql = "SELECT * FROM post2 ORDER BY id desc LIMIT 0,5";
        $stmt=$ConnectingDB->query($sql);
        while($DataRow = $stmt->fetch()){
          $Id   =$DataRow['id'];
          $Title  =$DataRow['title'];
          $DateTime  =$DataRow['datetime'];
          $Image  =$DataRow['image'];
         ?>
         <div class="media">
           <img src="Uploads/<?php echo htmlentities($Image); ?> " alt="" class="d-block img-fluid align-selg-start" width="90" heigh="94">
           <div class="media-body ml-2">
            <a href="fullPost.php?id=<?php echo htmlentites($Id);?>" target="_blank" sytle="text-decoration:none;"> <h6 class="lead"><?php echo htmlentites($Title);?></h6></a>
            <p class="smarl"><?php echo htmlentites($DateTime);?></p>
           </div>
         </div>
         <hr>
       <?php } ?>
      </div>
    </div>
    <!-- side area end -->
 </div>
</div>
</div>
</body>
</html>