<?php require_once("includes/db_connection.php"); ?>

<?php
	if($_SERVER['REQUEST_METHOD']=="POST"){
                $id=$_POST["id"];
	        $query="SELECT heart,gsr from signup where id={$id} ";
	        $res=mysqli_query($connection,$query);

	        if($res)
		     {
                       $result=mysqli_fetch_assoc($res);  
                     }
	        else
		     echo "Error occured";
                
                mysqli_free_result($res);
                
                $params=array();
                array_push($params,array(
                          "beat"=>$result["heart"],
		          "gsr"=>$result["gsr"]
                             )
                          );
}
                 echo json_encode(array("result"=>$params));

?>


<?php require_once("includes/db_close.php"); ?>	