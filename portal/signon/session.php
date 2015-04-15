<?php
	session_start();// Starting Session
	// Confirming that session exists and user can  view page
	if(!isset($_SESSION['logged_in_user']))	{
		header('Location:../index.php'); // Redirecting To Login Page
	}
	include("pdo-connect.php");
?>