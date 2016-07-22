<?php 
$db_server="localhost";
$db_username="1171163";
$db_password="shielded";
$db_name="1171163";

$connection=mysqli_connect($db_server,$db_username,$db_password,$db_name);
if(mysqli_errno()){
	die("Database Connection Failed ".mysqli_error()."(".mysqli_errno().")");
}

?>