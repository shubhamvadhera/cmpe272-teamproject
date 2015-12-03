<?php
	// start a session
	session_start();
	// check if user is logged in
	if (!(isset($_SESSION["login"]) && $_SESSION["login"] != "")) {
		header("Location: sign-in.html");
		exit;
	}

	print("you are in the marketplace <br />");
	print("you are signed in as {$_SESSION['username']} <br />");

	// logout
	print("<a href='logout.php'>Log out</a>");

?>
