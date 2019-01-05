<?php
	// Include config file
	require_once "config.php";
	
	$id = $username = $image = $admin = "";
	
	if(count($_COOKIE) > 0){
		if(isset($_COOKIE["c_user"])){
			$query = "SELECT id, username, image, admin FROM users WHERE password = ". $_COOKIE["c_user"] . "";
		
			$result = mysqli_query($link, $query);
		
		if($result){
			while($query_executed = mysqli_fetch_assoc($result)){
				$id = $query_executed["id"];
				$username = $query_executed["username"];
				$image = $query_executed["image"];
				$admin = $query_executed["admin"];
			}
			
			$_SESSION["loggedin"] = true;
            $_SESSION["id"] = $id;
            $_SESSION["username"] = $username;
            $_SESSION["image"] = $image;
			$_SESSION["admin"] = $admin;
			
			}
		}
	
	}

?>