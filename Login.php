<?php
include('./includes/Functions.php');
include("./includes/Session.php");
?>
<?php already_login();?>
<?php
 if(isset($_SESSION["UserId"])){
   //redirect_to('Dashboard.php');
 } 

  if(isset($_POST['Submit'])){
    $UserName = $_POST['username'];
    $Password = $_POST['Password'];
    if(empty($UserName) || empty($Password)){
      $_SESSION['ErrorMessage'] = "All field must be filled out............!";
      redirect_to("Login.php");
    }
    else{
      $found_account =login_Attempt($UserName,$Password);
      if($found_account){
        $_SESSION['UserId'] = $found_account['id'];
        $_SESSION['UserName'] = $found_account['username'];
        $_SESSION['AdminName'] = $found_account['aname'];
        $_SESSION['SuccessMessage'] = "Welcome".$_SESSION['AdminName']."!";
         redirect_to("Dashboard.php");
      }else{
        $_SESSION['ErrorMessage'] = "incorrect Username / Password";
        redirect_to('Login.php');
      }
    }
}
?>
<?php include("./inc/header.php");?>
<?php include("./inc/navbar.php");?>

    <!-- Main Area Start -->
    <section class="container py-2 mb-2">
      <div class="row">
        <div class="offset-sm-3 col-sm-6" style="min-height:500px;">
          <br><br><br>
          <?php
          echo ErrorMessage();
           echo SuccessMessage();
           ?>
          <div class="card text-light " style="background-color:black;">
            <div class="card-header text-center text-light">
              <h4 > Wellcome Back !</h4>
              </div>
              <div class="card-body bg-dark ">
              <form class="" action="Login.php" method="post">
                <div class="form-group">
                  <label for="username"><span class="FieldInfo">Username:</span>
                  <small class="text-muted"> *opt</small>
                </label>
                  
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text "> <i class="fas fa-user"></i> </span>
                    </div>
                    <input type="text" class="form-control" name="username" id="username" value="" placeholder="Enter Username">
                  </div>
                </div>
                <div class="form-group">
                  <label for="password"><span class="FieldInfo">Password:</span></label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"> <i class="fas fa-lock"></i> </span>
                    </div>
                    <input type="password" class="form-control" name="Password" id="password" placeholder="Enter password" value="">
                  </div>
                </div>
                <div class="form-group">
                   <div class="g-recaptcha" class="form-control mb-3" data-sitekey="6LfibhUeAAAAAAyhkFyogXIWkmmb6ItfIFZl25aL"></div>
                </div>
                <input type="submit" name="Submit" class="btn btn-warning btn-block" value="Login">              
              </form>
            </div>
          </div>
        </div>
      </div>

    </section>
    <!-- Main Area End -->
<?php include("./inc/footer.php");?>
