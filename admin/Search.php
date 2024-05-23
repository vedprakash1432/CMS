<?php 
include('./includes/Functions.php');
include('./includes/Session.php');
?>  
<?php
          global $ConnectingDB;
          //sql query when search button is active
          if(isset($_GET['SearchBtn'])){
              $Search = $_GET['search'];
         //     echo $Search;
              $sql ="SELECT * FROM post2 WHERE title LIKE :search 
              OR category LIKE :search 
              OR post LIKE :search";
              $stmt = $ConnectingDB->prepare($sql);
              $stmt->bindValue(':search','%'.$Search.'%');
              $stmt->execute();
              
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
              $Post_Description =$DataRow['post'];
        ?> 
        <?php } ?>