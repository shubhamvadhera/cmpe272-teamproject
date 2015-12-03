<?php
	// start a session.
	session_start();
	// extract POST data
	extract ($_POST);
    // Connect to mysql
    if (!($database = mysql_connect("localhost:3306", "vishwasm_admin", "admin123"))) {
       print("Failed to connect to the database. <br />" . mysql_error());
    }
    // Open the database
    if (!mysql_select_db("vishwasm_marketplace", $database)) {
       print("Failed to open the database. <br />" . mysql_error());
    }

    // if "login" button was clicked
    if (isset($login)) {
    	// create the query
    	$query = "SELECT * FROM user 
    				WHERE username = '$username'
    				AND password = '$password'";
    	// run the query
    	$result = mysql_query($query);
        // Check how many results were returned
       	$numResults = mysql_num_rows($result);

    	// user not registered or incorrect info
    	if ($numResults != 1) {
			// error_reporting(E_ALL | E_WARNING | E_NOTICE);
			// ini_set('display_errors', TRUE);
			// flush();

    		//header("Location: sign-in.html");
    		
    		// Send an alert message.
    		echo '<script type="text/javascript">'; 
		echo 'alert("incorrect username or password");'; 
		echo 'window.location.href = "sign-in.html";';
		echo '</script>';
		exit;
    	}
    	// correct login
    	else {
   //  		error_reporting(E_ALL | E_WARNING | E_NOTICE);
			// ini_set('display_errors', TRUE);
			// flush();
    		
    		$_SESSION['login'] = 'TRUE';
    		$_SESSION['username'] = $username;
    		// header("Location: marketplace.php");
    		header("Location: ../index.php");
    	}
    }

    // if "create-account" button was clicked
    if (isset($signup)) {
    	// check if all info is provided
    	if (!isset($username) || !isset($password)
    				|| empty($username) || empty($password)) {
    		print("Please provide both username and passowrd <br />");
    		print("<a href='sign-in.html'>try again</a>");
    		exit;
    	}
    	// check if user name is taken
    	$query = "SELECT * FROM user WHERE username = '$username'";
    	// run the query
    	$result = mysql_query($query);
        // Check how many results were returned
       	$numResults = mysql_num_rows($result);
    	if ($numResults > 0) {
    		/*
    		print("Username taken. <br />");
    		print("<a href='sign-in.html'>try again</a>");
    		exit;
    		*/
    		echo '<script type="text/javascript">'; 
		echo 'alert("username taken");'; 
		echo 'window.location.href = "sign-in.html";';
		echo '</script>';
		exit;
    	}

    	// create an insert statement
	    $insert = "INSERT INTO user (username, password, fname, lname)
    				VALUES ('$username', '$password', '$fname', '$lname')";
    	// execute the inert
    	if (!mysql_query($insert)) {
    		/*
    		print("User registeration failed <br />");
    		print("<a href='sign-in.html'>try again</a>");
    		*/
    		echo '<script type="text/javascript">'; 
		echo 'alert("user registration failed");'; 
		echo 'window.location.href = "sign-in.html";';
		echo '</script>';
		exit;
	   	 }
	    else {
	    	/*
	    	print("User created <br />");
	    	print("<a href='sign-in.html'>login</a>");
	    	*/
    		echo '<script type="text/javascript">'; 
		//echo 'alert("user successfully created");'; 
		echo 'window.location.href = "sign-in.html";';
		echo '</script>';
		exit;
	    }

	    
	}

?>