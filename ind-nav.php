<!-- navbar start -->
<div style="height:10px; background:black;"></div>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
     <i><a href="#" class="navbar-brand"> MICRONSOL.COM</a></i>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarcollapseCMS">
      <ul class="navbar-nav">
        <li class="nav-item dropdown float-right">
          <a href="#" class="nav-link text-light text-uppercase font-weight-bold px-3 dropdown-toggle" data-toggle="dropdown">Categories</a>
          <div class="dropdown-menu">
          <?php
            global $ConnectingDB;
            $sql = "SELECT id,category FROM category";
            $stmt = $ConnectingDB->query($sql);
            while ($DataRows = $stmt->fetch()) {
            $Category_Id = $DataRows["id"];
            $Category_Title = $DataRows["category"];
            ?>
            <a href="#" class="dropdown-item"> <?php echo $Category_Title; ?></a>
            <?php } ?>
        </div>
        </li>
        <li class="nav-item">
          <a href="index.php?page=0" class="nav-link" target="_blank">Live Blog</a>
        </li>            
      </ul>  
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a href="logout.php" class="nav-link text-info" style="border: 1px solid white;">
          <i class="fas fa-user-times"></i> Logout</a></li>
      </ul>   
      </div>
    </div>
</nav>
<div style="height:10px; background:black;"></div>





<ul>
     <!-- Trigger the modal with a button -->
     <li class="navbar-nav dropdown"><a class="nav-link text-light dropdown-toggle" data-toggle="dropdown" href="#">Menu</a>
             <div class="dropdown-menu">
                <a href="#" class="dropdown-item">My Profile</a>
                <a href="#" class="dropdown-item">Logout</a>
                <a href="#" class="dropdown-item">login</a>
                <a href="#" class="dropdown-item">Register</a>
             </div>
         </li>
</ul>