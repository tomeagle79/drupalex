<?php
	$Msg = "";		
	
	$connection = new mysqli("localhost", "anchordx_anchor", "ailyl;Ig!XLi", "anchordx_anchor");


	if ($connection->connect_errno) {
    	$Msg = "Error in connecting to the Database";	
	}
	else {
		mysqli_set_charset($connection,"utf8");			
	}	
?>