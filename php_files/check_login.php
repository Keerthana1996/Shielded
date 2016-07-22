<?php 
require_once("includes/db_connection.php");
require_once("includes/functions.php")
?>

<?php
     if(isset($_POST['submit'])){
    
         $id=$_POST['id'];  
         $password=$_POST['psswd'];
          
          $query="SELECT password FROM signup WHERE id={$id}";
          $res=mysqli_query($connection,$query);
          $result=mysqli_fetch_assoc($res);
          $existing_hash= $result['password'];
          if(password_check($password,$existing_hash)){
                  echo "Login Successful";           
          }
          
          mysqli_free_result($res);

}
     

?>

<html>
<form action="check_login.php" method="post">
    <input type="number" name="id">
     <input type="password" name="psswd">
     <input type="submit" name="submit">
</form>
</html>


<?php require_once("includes/db_close.php") ?>