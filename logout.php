<?php
include('./includes/Functions.php');
include("./includes/Session.php");

 session_destroy();
 redirect_to("login.php");

?>