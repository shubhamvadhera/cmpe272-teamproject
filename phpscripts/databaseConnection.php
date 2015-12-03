<?php 
	$username = "vishwasm_admin";
	$host = "localhost";
	$database = "vishwasm_marketplace";
	$password = "admin123";
	
	//Connect to Database
	$database = connectDB($host, $database, $username, $password);
	
	function connectDB($host, $database, $username, $password) {
	    if (!($conn = @mysql_connect($host, $username, $password))) {
	        die("Could not connect to database" . mysql_error());
	    }
	    if (!mysql_select_db($database, $conn)) {
	        die("Could not open database" . mysql_error());
	    }
	
	    return $conn;
	}
?>