<?php 
	// start a session
	session_start();
	// check if user is logged in. if not, send to login.
	if (!(isset($_SESSION["login"]) && $_SESSION["login"] != "")) {
		header("Location: ../login-sign-in/sign-in.html");
		exit;
	}
?>