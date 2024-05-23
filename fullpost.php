<?php 
include('./includes/Functions.php');
include('./includes/Session.php');
?>
<?php include("./inc/header.php");?>
<?php include("./inc/navbar.php");?>
<?php
$Post_Id =$_GET['id'];
?>

<!-- blogging details -->
<div class="container-fluid my-3 mb-3">
  <div class="row">
    <div class="col-lg-8 col-md-8">
      <!-- colom-1  -->
      <!-- search query start -->
      <?php
          global $ConnectingDB;
          //sql query when search button is active
          if(isset($_GET['SearchBtn'])){
              $Search = $_GET['search'];
         //    echo $Search;
              $sql ="SELECT * FROM post WHERE title LIKE :search 
              OR category LIKE :search 
              OR post LIKE :search
              OR datetime LIKE :search 
              OR id LIKE :search LIMIT 0,5";
              $stmt = $ConnectingDB->prepare($sql);
              $stmt->bindValue(':search','%'.$Search.'%');
              $stmt->execute();            
          
            }

          elseif(isset($_GET['page'])){
            $Page =$_GET['page'];
            if($Page==0 || $Page<1){
                $ShowPostForm = 0;
            }else{
                $ShowPostForm = $Page;
            }
            
            $sql ="SELECT * FROM post ORDER BY id desc LIMIT $ShowPostForm,4";
            $stmt= $ConnectingDB->query($sql);

           } else{


            $sql = "SELECT * FROM post WHERE id=$Post_Id";
            $Execute = $ConnectingDB->query($sql);
        }
             
      while ($DataRows=$Execute->fetch()) {
        $Post_Id  = $DataRows['id'];
        $Post_Title = $DataRows['title'];  
        $Post_Category = $DataRows['category'];  
        $Post_Image   = $DataRows['image'];
        $Post_Auther = $DataRows["author"];
        $Post_Description  = $DataRows['post']; 
        $Post_DateTime = $DataRows["datetime"];
      ?>
      <!-- colom-1 cards -->
      <div class="card mb-2">
        <div class="card-title">
          <h1 class=""> <b><i>Micronsol.com</i></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo  $Post_Title; ?></h1>
        </div>
        <img src="uploads/<?php echo htmlentities($Post_Image);?>" style="max-height:450px"
          class="img-fluid card-img-top img-thumbnail" alt="" />
        <div class="card-body">
          <h4 class="card-title">
            <?php echo  $Post_Title; ?>
          </h4>
          <div class="">
            <ol class="list-inline">
              <li class="list-inline-item">
                <small class="text-muted"> <i class="fa fa-tags"></i> Category: <Span class="text-dark"><a
                      href="blog.php?category=<?php echo htmlentities($Post_Category);?>">
                      <?php echo htmlentities($Post_Category);?>
                    </a> </Span>
                  <i class="fa fa-user"></i> Written by <span class="text-dark"><a
                      href="Profile.php?Username=<?php echo htmlentities($Post_Auther);?>">
                      <?php echo htmlentities($Post_Auther);?>
                    </a></span>
                  <i class="fa fa-calendar"></i> on <span class="text-dark">
                    <?php echo htmlentities($Post_DateTime); ?>
                  </span></small>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-dark badge-pil text-light" style="text-align: content-justify-right">
                  Comments <span class="badge badge-success"><?php echo TotalComments();?></span> </span>
              </li>
              <hr>
              <p class="card-text">
                <?php 
                  echo $Post_Description;?>
              </p>
              <a href="fullpost.php?id=<?php echo $Post_Id;?>" style="float:right;"></a>
            </ol>
          </div>
         
        </div>
      </div>
      <?php } ?>

      <div class="container">
        <div class="row">
          <div class="col">
            <h4 class="text-warning">Comments:</h4>
            <div class="card mt-4">
              <?php
                global $ConnectingDB;
                $sql="SELECT * FROM comments WHERE AproveComment=1 and post_id=$Post_Id";
                  $execute=$ConnectingDB->query($sql);
                  $sr=0;
                  while($Row=$execute->fetch()){
                  $id=$Row['id'];
                  $name=$Row['Name'];
                  $email=$Row['Email'];
                  $comments=$Row['Comments'];
                  $datetime=$Row['DateTime'];    

                ?>
              <div class="card-body shadow">
                <div class="row">
                  <div class="media ">
                    <img src="uploads/Employee-Placeholder-Image.jpg"
                      style="margin-rigth:30px ; width:140px;height:140px" alt="">
                    <div class="media-body ml-5">
                      <h5>
                        <?php echo $name; ?>
                        </h2>
                        <p>
                          <?php echo $datetime; ?>
                        </p>
                        <p>
                          <?php echo $comments; ?>
                        </p>
                    </div>
                  </div>
                </div>             
              </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
      <!-- comments backened code  -->
      <?php
if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $comments=$_POST['comments'];
    date_default_timezone_set("Asia/Kolkata");
  $CurrentTime=time();
  $Cotegory_DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);

   // echo $email;
    $sql="INSERT INTO `comments` ( `name`, `email`, `comments`, `datetime`,`post_id`) VALUES ( '$name', '$email', '$comments', ' $Cotegory_DateTime', '$Post_Id')";
    global $ConnectingDB;

    $stmt= $ConnectingDB->prepare($sql);
    $execute=$stmt->execute();
    if($execute){
      
        echo "<div class=\"text-success\">Successfull</div>";

    }else{
        echo "<div class=\"text-success\">Something went wrong</div>";
    }
}
?>
      <!-- backened  code of commnets ends from here -->

      <div class="container">
        <div class="row">
          <div class="col">
            <div class="card mb-4 mt-5 shadow ">
              <div class="card-header py-2 text-warning" style="background-color:#C0C0C0;">
                <h3>Share your thoughts about this post:</h3>
              </div>
              <div class="card-body ">
                <form action="" method="Post">
                  <div class="form-group">

                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text "> <i class="fas fa-user"></i> </span>
                      </div>
                      <input type="text" class="form-control" name="name" id="username" value=""
                        placeholder="Enter Username">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text "> <i class="fas fa-envelope"></i> </span>
                      </div>
                      <input type="email" class="form-control" name="email" id="username" value=""
                        placeholder="Enter E-mail">
                    </div>
                  </div>
                  <div class="form-group">
                    <textarea name="comments" class="form-control" id="" cols="30" rows="4"></textarea>
                  </div>
                  <div class="form-group">
                    <input type="submit" name="submit" class="form-control bg-warning">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- search query end -->

    </div>

    <!-- colom-2  -->
    <div class="col-lg-4 col-md-4">
      <!-- search box start -->
      <div class="search-box-container mb-4">
        <h4 class="text-center">Search</h4>
        <form class="search-post" action="blog1.php" method="GET">
          <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search .....">
            <span class="input-group-btn">
              <button type="submit" name="SearchBtn" class="btn btn-info"><i class="fa fa-search"></i> Search</button>
            </span>
          </div>
        </form>
      </div>
      <!-- /search box end -->

      <!-- sign-up card start -->
      <div class="card my-2">
        <div class="card-header bg-dark text-light text-center">
          <h4>Sign-up!</h4>
        </div>
        <div class="card-body">
          <div>
            <a href="#" class="btn btn-primary btn-block">Join to Us</a>
            <a href="login.php" class="btn btn-success btn-block" type="button">Login</a>
          </div>
          <form action="" class="form-inline">
            <div class="input-group my-2">
              <input type="email" placeholder="Enter email adress" class="form-control">
              <div class="input-group-append">
                <span class="input-group-text"><button type="button" class="btn btn-warning btn-small">Subscribe
                    Now</button></i></span>
              </div>
            </div>
          </form>
        </div>
      </div>
      <!-- sign-up card end -->
      <!-- category card start -->
      <div class="card my-2">
        <div class="card-header bg-dark text-light text-center">
          <h4>Categories</h4>
        </div>
        <div class="card-body text-decoration-none">
          <?php
              global $ConnectingDB;
              $sql = "SELECT * FROM category ORDER BY id desc LIMIT 5";
              $Execute =$ConnectingDB->query($sql);
              $SrNo = 0;
              while ($DataRows=$Execute->fetch()) {
              $Category_DateTime = $DataRows["datetime"];
              $Category =$DataRows['category'];
              $Category_Auther = $DataRows["author"];
              $SrNo++;
             ?>
          <!-- category-colors-code -->
          <table class="table">
            <?php 
                      if($SrNo%2==0){
                        echo '<tr class="table-light"> <td> <ul class="navbar-nav">
                        <li class="text-center"><a href="#" >'.$Category.' </a><br></li>
                        </ul> </td> </tr>';
                      }else{
                        echo '<tr class="table-active"> <td> <ul class="navbar-nav">
                        <li class="text-center"><a href="#" >'.$Category.' </a><br></li>
                        </ul> </td> </tr>';
                      }
                      ?>
          </table>
          <?php } ?>
        </div>
      </div>
      <!-- category card end -->

      <!-- recent post card start -->
      <div class="card ">
        <div class="card-header bg-info text-light text-center">
          <h4>Recent Posts</h4>
        </div>
        <p class="text-center">Read Recent Post <br> On <a href="#">
            <?php echo $Category_DateTime; ?>
          </a></p>
        <hr>
        <div class="card-body">
           <?php
                  global $ConnectingDB;
                  $sql = "SELECT * FROM post ORDER BY id desc LIMIT 5";
                  $Execute =$ConnectingDB->query($sql);
                  while ($DataRows=$Execute->fetch()) {
                  $AdminId = $DataRows['id'];
                  $Post_Auther =$DataRows['author'];
                  $Post_Image   = $DataRows['image']; 
                  $Post_Description  = $DataRows['post'];
                  $Post_Title   =$DataRows['title'];
                  $Post_DateTime   = $DataRows['datetime']; 
       
                  ?>
          <div class="media">
            <a href="fullpost.php?id=<?php echo $AdminId;?>"> <?php echo '<img src="./uploads/'.$Post_Image.'" class="" alt="" style="width:80px; height:70px">' ?> </a>
            <div class="media-body ml-3">
              <p><a href="fullpost.php?id=<?php echo $AdminId;?>">
                    <?php echo $Post_Title; ?><br><br>
                    <small><i class="fas fa-user"></i>&nbsp;&nbsp;Auther&nbsp;&nbsp;&nbsp;&nbsp;
                    <i class="fas fa-calendar"></i>&nbsp;&nbsp;Date &nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-tag"></i> &nbsp;&nbsp;Category</small>
                </a></p>
            </div>
          </div>
          <hr>
          <?php } ?>
        </div>
      </div>
      <!-- recent post card end -->
    </div>
  </div>
</div>

<?php include("./inc/footer.php");?>