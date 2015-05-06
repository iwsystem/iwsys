<?php
session_start();
	include_once("pdo-connect.php");
	// Define $myusername and $mypassword 
	$username=strtolower($_POST['username']);
	$password=strtolower($_POST['password']);	// This should be changed to have no strtolower() if users should have different combination of letters
	$loginIp = $_SERVER['REMOTE_ADDR'];
	$cookie_month = time() + 2678400;	// Time set for the login cookie
	try {
		// We Will prepare SQL Query
		$str_query = "	SELECT user_id, firstname, lastname, status, user_type, password, email
	    				FROM tbl_user
	    				WHERE username = :username;";
	    $str_stmt = $r_Db->prepare($str_query);
		// bind paramenters, Named paramenters alaways start with colon(:)
	    $str_stmt->bindParam(':username', $username);
		// For Executing prepared statement we will use below function
	    $str_stmt->execute();
		// Count no. of records	
	    $count = $str_stmt->rowCount();
		//just fetch. only gets one row. Use  fatch(PDO::FETCH_ASSOC) for making the result an associative array
		$row  = $str_stmt -> fetch();

		//	Checking if the user exists AND the password is correct after matching hashed passwords
		// User Redirect Conditions will go here
		if($count==1 && ( $row[5] == crypt($password, $row[5]) )) {
			if ($row[3] == 8) {	// If the user is inactive, redirect or write an error message
				//  Redirect to the invalid user page
            	header("location: ../../user_account_inactive.php"); 
			} else {
				$_SESSION["user_id"]=$row[0];
				$_SESSION["firstname"]=$row[1];
				$_SESSION["lastname"]=$row[2];
				$_SESSION["status"]=$row[3];
				$_SESSION["user_type"]=$row[4];
				$_SESSION["logged_in_user"]=$username;
				$_SESSION["email"]=$row[6];
				
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

					// Another Query to retrieve the last log-in time
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
						
				//	Set Cookie to remember credentials
				if($_POST['remember']) {
					setcookie('remember_me', $username, $cookie_month);
				} elseif(!$_POST['remember']) {	// If user did not select Remembr Me, but there was a cookie in the system, remove the cookie
					if(isset($_COOKIE['remember_me'])) {
						$past = time() - 100;
						setcookie('remember_me', $username, $past);
					}
				}
				//	Condition to redirect user to ideal page
				if($_SESSION["user_type"] == 1)  {
					// We Will prepare SQL Query to retrieve employees id and role
					$str_query = "	SELECT emp_id, role_id
				    				FROM tbl_employee
				    				WHERE user_id = :user_id;";
				    $str_stmt = $r_Db->prepare($str_query);
					// bind paramenters, Named paramenters alaways start with colon(:)
				    $str_stmt->bindParam(':user_id', $_SESSION["user_id"]);
					// For Executing prepared statement we will use below function
				    $str_stmt->execute();
					// fetch only gets one row. Use  fatch(PDO::FETCH_ASSOC) for making the result an associative array
					$row  = $str_stmt -> fetch();
					$_SESSION["emp_id"]=$row[0];	//	setting a session varaible for the id of the staff
					$_SESSION["role_id"]=$row[1];	// setting a session variable for the role of the staff

					// Checking if this is a first time login
					if($_SESSION["status"] == 7) {
						//	Redirect to the staff first time login page
						header("location:first_time_login.php");		
					} else {
						//	Redirect to the staff portal home page
						header("location:../stf_home.php");	
					}
				}   else    { 
					// Checking if this is a first time login
					if($_SESSION["status"] == 7) {
						//	Redirect to the staff first time login page
						header("location:first_time_login.php");		
					} else {
						//	Redirect to the customer portal home page
						header("location:../cli_home.php");
					}
				}	
			}
		} else {
            //  Redirect to the invalid user page
            header("location: ../../invalid_user_login.php"); 
		}
	}	catch(PDOException $e)	{
		echo "Connection failed: " . $e->getMessage();
	}
	// Closing MySQL database connection   
    $r_Db = null;
?>