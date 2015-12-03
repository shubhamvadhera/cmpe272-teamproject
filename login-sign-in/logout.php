<?php

	session_start();
	session_destroy();
	//header("Location: sign-in.html");
	//header("Location: ../index.php");
    	echo '<script type="text/javascript">'; 
	echo 'alert("user logged out");'; 
	echo 'window.location.href = "../index.php";';
	echo '</script>';
	exit;
?>