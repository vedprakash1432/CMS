
<?php 
include('./includes/Functions.php');
include('./includes/Session.php');
?>  
<?php include("./inc/header.php");?>
<?php include("ind-nav.php");?>

  <!-- blogging details -->
  <div class="container-fluid my-3 mb-3">
    <?php
       echo ErrorMessage();
       echo SuccessMessage();
     ?>
    <div class="row"> 
      <div class="col-lg-8 col-md-8">
         <!-- colom-1  -->
         <!-- search query start -->
         <?php
          global $ConnectingDB;
          //sql query when search button is active
          if(isset($_GET['SearchBtn'])){
              $Search = $_GET['search'];
        
              $sql ="SELECT * FROM post WHERE title LIKE :search 
              OR category LIKE :search 
              OR post LIKE :search
              OR datetime LIKE :search 
              OR id LIKE :search LIMIT 0,4";
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

           }else{
            $sql = "SELECT * FROM post ORDER BY id desc LIMIT 3";
            $stmt =$ConnectingDB->query($sql);
        }
                
      while ($DataRows=$stmt->fetch()) {
        $Post_Id  = $DataRows['id'];
        $Post_Title =$DataRows['title'];  
        $Post_Category =$DataRows['category'];  
        $Post_Image   = $DataRows['image'];
        $Post_Auther = $DataRows["author"];
        $Post_Description  = $DataRows['post']; 
        $Post_DateTime = $DataRows["datetime"];
       
         ?>               
          <!-- colom-1 cards -->
        <div class="card mb-2"> 
         <img src="uploads/<?php echo htmlentities($Post_Image);?>" style="max-height:450px" class="img-fluid card-img-top img-thumbnail" alt=""/>
           <div class="card-body">
             <h5 class="card-title"><?php echo $Post_Title; ?> </h5>
              <div class="">
              <ol class="list-inline">
                <li class="list-inline-item">
                  <small class="text-muted"> <i class="fa fa-tags"></i>  Category: <Span class="text-dark"><a href="blog.php?category=<?php echo htmlentities($Post_Category);?>"> <?php echo htmlentities($Post_Category);?> </a> </Span> 
                   <i class="fa fa-user"></i> Written by <span class="text-dark"><a href="Profile.php?Username=<?php echo htmlentities($Post_Auther);?>"><?php echo htmlentities($Post_Auther);?></a></span>
                    <i class="fa fa-calendar"></i> on <span class="text-dark"><?php echo htmlentities($Post_DateTime); ?></span></small>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-dark badge-pil text-light">  Comments  <span class="badge badge-success"><?php echo TotalComments();?></span> </span> 
                </li>
                <hr>
                 <p class="card-text">
                  <?php if(strlen($Post_Description)>80){ $Post_Description = substr($Post_Description,0,80)."...";}
                  echo htmlentities($Post_Description);?>
                 </p>
                  <a href="fullpost.php?id=<?php echo $Post_Id;?>" style="float:right;"> <span class="btn btn-info">Read More</span>
                  </a>
              </ol>
            </div>             
             <!-- full post 2nd method  -->
             <!-- <div class="text-right">
               <button type="button" onclick="myFunction()" id="myBtn" class="btn btn-info text-light"> Read More </button>
              </div> -->
            </div>
          </div>        
          <?php } ?>
          <!-- search query end -->
          
    <!-- pagenation starts here -->
   <nav>
    <ul class="pagination-lg pagination justify-content-center">
        <!-- Creating Backward Button -->
        <?php if(isset($Page)){
            if($Page>1){?>
            <li class="page-item">
                <a href="index.php?page=<?php echo $Page-1 ?> "  class="page-link"><h5>Pre</h2></a>
            </li>
            <?php } ?>

            <?php
            global $ConnectingDB;
            $sql="SELECT COUNT(*) FROM post";
            $stmt=$ConnectingDB->query($sql);
            $RowPagination=$stmt->fetch();
            $TotalPosts=array_shift($RowPagination);
            // echo $TotalPosts."<br/>";
            $PostPagination=$TotalPosts/4;
            $PostPagination =ceil($PostPagination);           
            // echo $PostPagination;
            for($i=0; $i<=$PostPagination;$i++){
            if(isset($Page)){
                if($i==$Page){?>
                <li class="page-item active">
                    <a href="index.php?page=<?php echo $i;?> " class="page-link "> <?php echo $i; ?> </a>
                </li>
                <?php 
                }else{
                    ?>  <li class="page-item">
                        <a href="index.php?page=<?php echo $i;?> " class="page-link "><?php  echo $i;?></a>
                    </li>
                <?php } 
                }
               } 
             } ?>                    
                <!-- Creating Forward Button -->
                <?php if(isset($Page ) && !empty($Page)){
                    if($Page>1) {?>
                <li  class="page-item">
                    <a href="index.php?page=<?php echo $Page+1; ?>" class="page-link "><h5>Next</h5></a>
                </li> 
                <?php }} ?>                                                        
                </ul>
            </nav>
            <!-- pagenation ends here -->           

        </div>
        
          <!-- colom-2  -->     
        <div class="col-lg-4 col-md-4"  >
           <!-- search box start -->
            <div class="search-box-container mb-4">
              <h4 class="text-center">Search</h4>
              <form class="search-post" action="" method ="GET">
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
         <div class="card my-2" >
            <div class="card-header bg-dark text-light text-center">
               <h4 >Sign-up!</h4>
            </div>
             <div class="card-body">
                <div>
                   <a href="registration.php" class="btn btn-primary btn-block">Join to Us</a> 
                   <a href="Login.php"class="btn btn-success btn-block" type="button">Login</a>
                </div>
                <form action="" class="form-inline">
                <div class="input-group my-2">
                    <input type="email" placeholder="Enter email adress" class="form-control">
                    <div class="input-group-append">
                        <span class="input-group-text"><button type="button" class="btn btn-warning btn-small">Subscribe Now</button></i></span>
                    </div>
                </div>
            </form>
             </div>
         </div>
          <!-- sign-up card end -->
          <!-- category card start -->
         <div class="card my-2" >
            <div class="card-header bg-dark text-light text-center">
               <h4 >Categories</h4>
            </div>
             <div class="card-body text-decoration-none">
             <?php
              global $ConnectingDB;
              $sql = "SELECT * FROM category ORDER BY id desc LIMIT 5";
              $Execute =$ConnectingDB->query($sql);
              $SrNo = 0;
              while ($DataRows=$Execute->fetch()) {
              $Category_Id =$DataRows['id'];
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
            <?php
              global $ConnectingDB;
              $sql ="SELECT * FROM post";
              $Execute =$ConnectingDB->query($sql);
              $result = $Execute->fetch();
              $Post_DateTime   = $result['datetime']; 
            ?>
            <div class="card-header bg-info text-light text-center">
               <h4 >Recent Posts</h4>
            </div>
            <p class="text-center">Read Recent Post <br> On  <a href="#"><?php echo $Post_DateTime; ?></a></p><hr>
             <div class="card-body">
               <?php
                  global $ConnectingDB;
                  $sql = "SELECT * FROM post ORDER BY id desc LIMIT 5";
                  $Execute =$ConnectingDB->query($sql);
                  while ($DataRows=$Execute->fetch()) {
                  $Post_Id = $DataRows['id'];
                  $Post_Image   = $DataRows['image']; 
                  $Post_Title =$DataRows['title'];
                  $Post_Auther =$DataRows['author'];
                  $Post_Category =$DataRows['category'];
                  $Post_Description  = $DataRows['post'];
                  $Post_DateTime   = $DataRows['datetime']; 
                  
                  ?>            
                 <div class="media">
                    <a href="fullpost.php?id=<?php echo $Post_Id;?>"> <?php echo '<img src="./uploads/'.$Post_Image.'" class="" alt="" style="width:80px; height:70px">' ?> </a>
                  <div class="media-body ml-3">
                      <p><a href="fullpost.php?id=<?php echo $Post_Id;?>">   
                        <?php echo $Post_Title;?> </a></p>
                        <small>  
                           <i class="fas fa-user"></i> &nbsp;&nbsp;<?php echo $Post_Auther;?> &nbsp;&nbsp; &nbsp;
                          <i class="fas fa-calendar"></i> &nbsp;&nbsp;<?php echo $Post_DateTime; ?>
                      </small>
                  </div>
                 </div><hr>
                <?php } ?>
              </div>
         </div> 
        <!-- recent post card end -->             
      </div>
    </div>      
  </div>
<?php include("./inc/footer.php");?>