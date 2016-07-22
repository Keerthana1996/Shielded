<?php

function set_values(){
	global $connection;
        if(isset($_POST["id"])){
                $id=$_POST["id"];
        }
	if(isset($_POST["name"])){
		$name=mysqli_real_escape_string($connection,$_POST["name"]);
	}
	if(isset($_POST["age"])){
		$age=$_POST["age"];
	}
	if(isset($_POST["phno"])){
		$phno=$_POST["phno"];
	}
	if(isset($_POST["email"])){
		$email=mysqli_real_escape_string($connection,$_POST["email"]);
	}
	if(isset($_POST["password"])){
		$password=$_POST["password"];
	}
        if(isset($_POST["mac"])){
                $mac=mysqli_real_escape_string($connection,$_POST["mac"]);
        }
	$values=array($id,$name,$age,$phno,$email,$password,$mac);
	return $values;
}


//password encryption related functions
function password_encrypt($password){
       $hash_format="$2y$10$";
       $salt_length=22;
       $salt=generate_salt($salt_length);
       $format_and_salt=$hash_format.$salt;
       $hash=crypt($password,$format_and_salt);
    return $hash;
}

function generate_salt($salt_length){
      $unique_random_string=md5(uniqid(mt_rand(),true));
      $base64_string=base64_encode($unique_random_string);
      $modified_string=str_replace('+','.',$base64_string);

      $salt=substr($modified_string,0,$salt_length);
   return $salt;
}

function password_check($password,$existing_hash){
     $hash=crypt($password,$existing_hash);
     echo "hash: {$hash},      existing: {$existing_hash}";
     if($hash==$existing_hash)
            return true;
     else
            return false;
}

?>