<?php
	// start a session
	session_start();
	
	echo "username : ";
	echo $_SESSION['username'];
	echo "<br />";
	echo "login status : ";
	echo $_SESSION['login'];
	echo "<br />";
	echo "email : ";
	echo $_SESSION['EMAIL'];
	echo "<br />";
	echo "first name : ";
	echo $_SESSION['FNAME'];
	echo "<br />";
	echo "lname : ";
	echo $_SESSION['LNAME'];
	//echo $_SESSION['FULLNAME'];
	//echo "test";
?>