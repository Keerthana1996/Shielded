<?php require_once("includes/db_connection.php") ?>

<?php
      $query="SELECT * from signup";
      $res=mysqli_query($connection,$query);
      
      while($result=mysqli_fetch_assoc($res))
      {
         echo "<pre>";
         print_r ($result);
         echo "</pre>";
      }

mysqli_free_result($res);
?>

<?php require_once("includes/db_close.php") ?>	