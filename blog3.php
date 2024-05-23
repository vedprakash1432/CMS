<?php 
include('./includes/Functions.php');
include('./includes/Session.php');
?>  

<!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <link rel="stylesheet" href="css/bootstrap.min.css">
     <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> 
  
    
 </head>     
 <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-fixed">
        <div class="container">
            <a href="#" class="navbar-brand fa-3x " >Micronsol.com </a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarcollapseCMS">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a href="#" class="nav-link btn-outline-success">
                           <i class="fas fa-user text-success"></i> 
                           My Profile
                         </a>
                    </li>
                    <li class="nav-item">
                        <a href="Dashboard.php " class="nav-link btn-outline-success">Dashboard</a>
                    </li>
                    <li class="nav-item">
                       <a href="AddNewPost.php" class="nav-link btn-outline-success">Posts</a>
                    </li>
                   <li class="nav-item">
                       <a href="category.php" class="nav-link btn-outline-success">Category</a>
                  </li>
                  <li class="nav-item">
                     <a href="AddNewAdmin.php" class="nav-link btn-outline-success">Manage Admin</a>
                 </li>
                 <li class="nav-item">
                     <a href="#" class="nav-link btn-outline-success">Comments</a>
                 </li>
                 <li class="nav-item">
                    <a href="#" class="nav-link btn-outline-success ">Live Blog</a>
                 </li>
                </ul>
                <ul class="navbar-nav  ml-auto">
                    <li class="nav-item">
                        <a class="nav-link text-danger border border warning  btn-outline-warning " href="Logout.php">
                           <i class="fas fa-user-times"></i>
                           Logout
                        </a>
                    </li>
                </ul>
     
            </div> 
        </div>
    </nav>
    <!--  Navbar ends from here-->
    <div style="height: 10px; background-color: blue;"></div>
 
    
<div class="container">
    <div class="row shadow" >
        <div class="col-lg-8 col-md-6 col-sm-7"  >
            <div class="card shadow mt-4">
                <?php
                // search button code
                global $ConnectingDB;
                $check=true;

                if(isset($_GET["SearchButton"])){
                    $Search=$_GET["Search"];
                    // echo $Search;
                    $sql="SELECT * FROM post2
                     WHERE datetime LIKE :search
                      OR title LIKE :search
                      OR title LIKE :search

                     OR category LIKE :search
                      OR post LIKE :search";
                    $stmt=$ConnectingDB->prepare($sql);
                    $stmt->bindValue(':search', '%'.$Search.'%');
                 $Execute = $stmt->execute();
        
                }elseif(isset($_GET["page"])){
                    $Page=$_GET["page"];
                    if($Page==0|| $Page<1){
                        $ShowPostFrom=0;
                    }else{
                        $ShowPostFrom=$Page;
                        
                    }
            
                 $sql="SELECT * FROM post2 ORDER BY id desc LIMIT $ShowPostFrom,3";
                $stmt=$ConnectingDB->query($sql);
                    }

                
                // the default sql query
               else{ $sql = "SELECT * FROM post2 ORDER BY id desc ";
                $stmt =$ConnectingDB->query($sql);
               }
               
                while ($DataRows=$stmt->fetch()) {
                 $Id=$DataRows['id'];
                  $image   = $DataRows['image'];
                  $Post  = $DataRows['post'];
                  $DateTime = $DataRows["datetime"];
                  $Category =$DataRows['title'];
                  $AdminUsername = $DataRows["author"];
          
                 echo '<img src="uploads/'.$image.'" style="width:100%; height:300px;"/>';
               
                 //'<img src="uploads/'.$image.'" style="width:80px; height:70px;"/>'; 
               ?>
                              
                <div class="card-body">
                  <h5 class="card-title">The cool laptop in History</h5>
                <div class="text-right"> 
                 <a href=""> <span class="badge badge-dark">Comments  <span class="badge badge-primary ">9</span></span></a>                                           
               </div>
                  <p class="card-text">Author <i class="text-primary"> <?php echo $AdminUsername;?> &nbsp</i>  <i class="text-primary"><?php echo $Category;  ?> &nbsp  </i>created on  <?php echo $DateTime; ?> </p><hr>
                  <p class="card-subtext"><i><?php echo substr($DataRows['post'],0,80);
                  ?> </i></p>  
                  
                   <div class="text-right">  <a href="" class="font-weight-bold text-light text-right btn btn-primary">read more</a>
                <div class="mt-2"></div>
                </div>   
         </div>
               <?php } ?>

<!-- pagenation starts here -->
   <nav>
    <ul class="pagination-lg pagination">
        <!-- Creating Backward Button -->
        <?php if(isset($Page)){
            if($Page>1){?>
            <li class="page-item ">
                <a href="blog3.php?page=<?php echo $Page-1 ?> "  class="page-link"><h5>Pre</h2></a>
            </li>
            <?php } ?>

            <?php
            global $ConnectingDB;
            $sql="SELECT COUNT(*) FROM post2";
            $stmt=$ConnectingDB->query($sql);
            $RowPagination=$stmt->fetch();
            $TotalPosts=array_shift($RowPagination);
            // echo $TotalPosts."<br/>";
            $PostPagination=$TotalPosts/4;
            $PostPagination =ceil($PostPagination);           
            // echo $PostPagination;
            for($i=1; $i<= $PostPagination;$i++){
                if(isset($Page)){
                    if($i==$Page){?>
                    <li class="page-item active">
                        <a href="blog3.php=<?php echo $i;?> " class="page-link "> <?php echo $i; ?> </a>
                    </li>
                    <?php 
                    }else{
                        ?>  <li class="page-item">
                            <a href="blog3.php?page=<?php echo $i ;?> " class="page-link " > <?php  echo $i;?></a>
                        </li>
                    <?php } 
                    }
                   } 
                } ?>                    
                <!-- Creating Forward Button -->
                <?php if(isset($Page ) && !empty($Page)){
                    if($Page>1) {?>
                <li  class="page-item">
                    <a href="blog3.php?page=<?php echo $Page+1; ?>" class="page-link "><h5>Next</h5></a>
                </li> 
                <?php } } ?>                                                        
                </ul>
            </nav>
            <!-- pagenation ends here -->           
            </div>
        </div>
        
        <di class="col-lg-4 col-md-6 col-sm-5 px-5">

        <div class="card-body ">
            <h3 class="text-center">Search here:</h3>
                    <form action="Post3.php" method="get" >
                    <div class="input-group ">
                        <input type="text" class="form-control " name="Search" placeholder="Search here:">
                        <div class="input-group-append">
                        <!-- <button class="btn btn-outline-primary btn-block text-center text-primary " name=" SearchButton"   >Search </button> -->
                       <button  class="btn btn-primary" name="SearchButton" name="SearchButton">Go</button> 

                        </div>
                    </div>
                    </form>
                </div>
            <br>
            <div class="card shadow">
                <div class="card-header bg-dark text-light shadow">
                    <h2 class="lead text-center">Sign Up!</h2>
                </div>
                <div class="card-body">
                    <form action="">
                    <button class="btn btn-outline-success btn-block text-center text-primary mb-4 " type="button">Join Now</button>
                    <button class="btn btn-outline-danger btn-block text-center text-primary mb-4" type="button">Login Now</button>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control " placeholder="Enter your email">
                        <div class="input-group-append">
                    <button class="btn btn-outline-primary  btn-block text-center text-primary " type="button">Subscribe </button>
                        
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <br>
            <div class="card shadow mt-2">
                <div class="card-header bg-primary ">
                    <h2 class="lead text-light text-center">Categories</h2>
                </div>
                    <div class="card-body">
                              
            <?php
 global $ConnectingDB;
 $sql = "SELECT * FROM category ORDER BY id desc";
 $Execute =$ConnectingDB->query($sql);
 $SrNo = 0;
 while ($DataRows=$Execute->fetch()) {
   $AdminId = $DataRows["id"];
   $DateTime = $DataRows["datetime"];
   $Category =$DataRows['title'];
   $AdminUsername = $DataRows["author"];
   $SrNo++;

     ?>
   <?php
           if($SrNo%2==0){
             echo '<table class="table shadow">
             
             <tr class="table-warning">
             <td>  
             <ul class="navbar-nav">
             <li  class="text-center" ><a  >  '. $Category.' </a></li> 
             </ul>
             </td>
             </tr>
             </table>';
           } else{ 
              echo '<table class="table shadow">
          
           <tr class="table-danger shadow">
           <td>  
           <ul class="navbar-nav ">
           <li class="text-center "  ><a href="#" >  '. $Category.' </a></li> 
           </ul>
           </td>
           </tr>
           </table>';
           }
         ?>
 
            <?php } ?>    
                    </div>
                </div>
                <div class="card shadow mt-3">
                    <div class="card-header bg-primary">
                        <h5 class="text-light text-center">Recent Post</h5>
                    </div>
                    <div class="card-body">
                   <?php
                    global $ConnectingDB;
                    $sql = "SELECT * FROM post2 ORDER BY id desc limit 4";
                    $Execute =$ConnectingDB->query($sql);
                    
                    while ($DataRows=$Execute->fetch()) {
                    
                        $image   = $DataRows['image']; 
                        $Post  = $DataRows['post'];
                        $Category =$DataRows['title'];  
                    ?>
                        <div class="media">
                            <img src="uploads/<?php echo $image; ?>"class="d-block img-fluid align-self-start" width="90" height="94" alt="">
                            <div class="media-body ml-2">
                             <h6 class="lead"><a href=""><?php echo $image ?></a></h6>
                            </div>
                             
                        </div>
                        <hr>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <br>
        </div>
    </div>
</div>


<footer class="bg-dark text-white" >
        <div class="container"  >
            <div class="row">
                <div class="col">
                    <p class="lead text-center">Theme by | Micronsol | Vijay Chaurasiya | <span id="year"></span> - All rights reserved.</p>
                    <p class="text-center small"><a href="#" style="color:white; text-decoration:none; cursor:pointer">This website is only used for Study purpose in &trade; Micron Infotech. Micron Infotech has all rights, no one is allowed to distribute copies other than <br/> &trade;  microninfitech.com. &trade; Skillshare</a></p>
                </div>
            </div>
        </div>
    </footer>
</body>
 </html>