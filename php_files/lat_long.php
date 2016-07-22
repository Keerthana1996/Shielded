<?php require_once("includes/db_connection.php"); ?>

<?php 
      if($_SERVER['REQUEST_METHOD']=="POST"){
           $id=$_POST["id"];
           $lat=$_POST["latitude"];
           $long=$_POST["longitude"];

           $query="UPDATE signup ";
           $query.="set latitude='{$lat}' ";
           $query.=", longitude='{$long}' ";
           $query.="where id={$id}";
           
           $result=mysqli_query($connection,$query);

           if($result && mysqli_affected_rows($connection)==1)
                    echo "Updation Successful";
           else
                    echo "Location Updation Failed";

      }

?>

<?php require_once("includes/db_close.php"); ?>