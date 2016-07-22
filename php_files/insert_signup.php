<?php 
require_once("includes/db_connection.php");
require_once("includes/functions.php")
?>

<?php
 if($_SERVER['REQUEST_METHOD']=="POST"){
              list($id,$name,$age,$phno,$email,$password,$mac)=set_values();
              $hashed_password=password_encrypt($password);

              //Insertion Query
	      $query="INSERT INTO signup(id,name,age,phno,email,password,mac) ";
	      $query.="VALUES('{$id}','{$name}',{$age},{$phno},'{$email}','{$hashed_password}','{$mac}') ";

	      $result=mysqli_query($connection,$query);

	      if($result){
		  echo "Details inserted successfully";
              }
	      else{
		  echo "Insertion Unsuccessfull";
              }

      }
?>


<?php require_once("includes/db_close.php") ?>
					