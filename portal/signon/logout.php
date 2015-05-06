<?php
	session_start();
	if(session_destroy())	{ // Destroying All Sessions 
		// echo "please wait ...";
		//	Unset cookie
		$past = time() - 100;
		setcookie('remember_me', 'gone', $past);
		header("Location: ../../index.php"); // Redirecting To Home Page
	}
?>