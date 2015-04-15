<?php
	session_start();
	if(session_destroy())	{ // Destroying All Sessions 
		// echo "please wait ...";
		header("Location: ../../index.php"); // Redirecting To Home Page
	}
?>