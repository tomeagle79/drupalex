<?php
	$Msg = "";		
	
	$connection = new mysqli("localhost", "root", "root", "form_test");


	if ($connection->connect_errno) {
    	$Msg = "Error in connecting to the Database";
	}
	else {
		mysqli_set_charset($connection,"utf8");			
	}	
?>
