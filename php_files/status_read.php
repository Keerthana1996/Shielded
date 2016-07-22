<?php 
    require_once("includes/db_connection.php");
?>

<?php 
    $query="SELECT id,name,age,phno,email,latitude,longitude FROM signup WHERE status=1";
    $res=mysqli_query($connection,$query);

    $rows=mysqli_num_rows($res);
    
    if($rows==0){
      $ids=array();
      echo json_encode(array("results"=>$ids));
    }
     
    if($rows>0){
      $ids=array();
      while($result= mysqli_fetch_assoc($res)){
        array_push($ids,array(
                   "id"=>$result['id'],
		   "name"=>$result['name'],
		   "age"=>$result['age'],
                   "phno"=>$result['phno'],
		   "email"=>$result['email'],
                   "latitude"=>$result['latitude'],
                   "longitude"=>$result['longitude'] 
                     )
                  );
      }
    
      mysqli_free_result($res);
    
      echo json_encode(array("result"=>$ids));
    }
    
?>

<?php require_once("includes/db_close.php"); ?>	