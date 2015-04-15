<?php
include_once('session.php');
include_once("pdo-connect.php");
	$i_uID = $_SESSION["user_id"]; // This is the id of the user
	try {
	    // We Will prepare SQL Query
	    $str_query = "  SELECT *
	                    FROM tbl_user
	                    WHERE  user_id = :id;";
	    $str_stmt = $r_Db->prepare($str_query);
	    // bind paramenters, Named paramenters alaways start with colon(:)
	    $str_stmt->bindParam(':id', $i_uID);
	    // For Executing prepared statement we will use below function
	    $str_stmt->execute();
	    $arr_Details = $str_stmt->fetch(PDO::FETCH_ASSOC);
	}   catch(PDOException $e)  {
	        echo "Connection failed: " . $e->getMessage();
	}
	// Closing MySQL database connection   
	$r_Db = null;
?>