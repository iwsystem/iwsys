<?php
session_start();
	include_once("pdo-connect.php");
	// Define $myusername and $mypassword 
	$username=strtolower($_POST['username']);
	$password=strtolower($_POST['password']);
	$loginIp = $_SERVER['REMOTE_ADDR'];
	try {
		// We Will prepare SQL Query
		$str_query = "	SELECT user_id, firstname, lastname, status, user_type
	    				FROM tbl_user
	    				WHERE username = :username 
	    				AND password = :password;";
	    $str_stmt = $r_Db->prepare($str_query);
		// bind paramenters, Named paramenters alaways start with colon(:)
	    $str_stmt->bindParam(':username', $username);
	    $str_stmt->bindParam(':password', $password);
		// For Executing prepared statement we will use below function
	    $str_stmt->execute();
		// Count no. of records	
	    $count = $str_stmt->rowCount();
		//just fetch. only gets one row. Use  fatch(PDO::FETCH_ASSOC) for making the result an associative array
		$row  = $str_stmt -> fetch();
		// User Redirect Conditions will go here
		if($count==1) {
			$_SESSION["user_id"]=$row[0];
			$_SESSION["firstname"]=$row[1];
			$_SESSION["lastname"]=$row[2];
			$_SESSION["status"]=$row[3];
			$_SESSION["user_type"]=$row[4];
			$_SESSION["logged_in_user"]=$username;
			
	/*		//	If there is a different page for admin user, this could be used to redirect to the correct page
			if($row[0] == 0)  {
			header( "location: ../Adminhome.php"); 	
			}   else    { 
			header( "location: ../home.php");  
			}*/

			//	Redirect to the portal home page
			header("location:../cli_home.php"); 
		} else {
			echo "Invalid Username or Password, if this continues, contact administrator<br>";
			echo "You will be returned to login page in 5 seconds OR Click the back button to return<br> Redirecting ...";
			header("refresh:5; url=../../index.php");
		}
		//	This condition makes sure that the user exists before the next queries will be evaluated
		if (isset($_SESSION["user_id"])) {
			$i_uID = $_SESSION["user_id"];	// Creating a variable: user id from the session. This would be used subsequently in other queries
			//	Perform another query to update the login history table
	        $str_query = "  INSERT INTO tbl_login_history (user_id, login_time, login_ip)
	                        VALUES (:user_id, NOW(), :login_ip);";
	        $str_stmt = $r_Db->prepare($str_query);
	        // bind paramenters, Named paramenters alaways start with colon(:)
	        $str_stmt->bindParam(':user_id', $i_uID);
	        $str_stmt->bindParam(':login_ip', $loginIp);
	        // For Executing prepared statement we will use below function
	        $str_stmt->execute();

			// Another Query to retrieve the last log in time
			$str_query = "	SELECT login_time
		    				FROM tbl_login_history
		    				WHERE user_id = :user_id
		    				ORDER BY id DESC
		    				LIMIT 1, 2;";	// Using the Limit 1, 2 selects the second row. This is because we don't want to get teh last login which is now, but the login before now
		    $str_stmt = $r_Db->prepare($str_query);
			// bind paramenters, Named paramenters alaways start with colon(:)
		    $str_stmt->bindParam(':user_id', $i_uID);
			// For Executing prepared statement we will use below function
		    $str_stmt->execute();
			//just fetch. only gets one row. Use  fatch(PDO::FETCH_ASSOC) for making the result an associative array
			$row  = $str_stmt -> fetch();
			//	Create a new session varaible of the last logi time
			$_SESSION["last_login"]=$row[0];
		}
	}	catch(PDOException $e)	{
		echo "Connection failed: " . $e->getMessage();
	}
	// Closing MySQL database connection   
    $r_Db = null;
?>