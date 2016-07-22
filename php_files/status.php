<?php require_once("includes/db_connection.php"); ?>

<?php
	if($_SERVER['REQUEST_METHOD']=="GET"){
                $string=explode(",",$_GET['status']);
                $status=$string[0];
                $heart=$string[1];
                $gsr=$string[2];

	        $query="UPDATE signup set status={$status}, heart={$heart}, gsr={$gsr} WHERE mac='984FEE0189DC' ";
	        $result=mysqli_query($connection,$query);

	        if($result)
		     echo "Updation successfull";
	        else
		     echo "Updation Unsuccessfull";
}

?>

<?php require_once("includes/db_close.php"); ?>			