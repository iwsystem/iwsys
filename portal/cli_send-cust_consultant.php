<?php
	include_once('signon/session.php');
	include_once("signon/pdo-connect.php");

    $str_msg_title = $_POST['title']; // Variable for the title of the message from customer
    $int_msg_project = $_POST['project']; // Variable for the project of the customer
    $str_msg_desc = $_POST['message_description']; // Variable for the Message from the customer
    $int_user = $_POST['us']; // Variable for the user_id of the customer

	//  Code to store the inputed data into the database table
    try {
    	//	Query to retrieve the employee ID Associated with the project
        $str_query = "  SELECT emp_id
                        FROM tbl_project
                        WHERE  proj_id = :proj_id;";
        $str_stmt = $r_Db->prepare($str_query);
        // bind paramenters, Named paramenters alaways start with colon(:)
        $str_stmt->bindParam(':proj_id', $int_msg_project);
        // For Executing prepared statement we will use below function
        $str_stmt->execute();
        $arr_Project = $str_stmt->fetch();
        $int_emp = $arr_Project[0];
    }   catch(PDOException $e)  {
        echo "Connection failed: " . $e->getMessage();
    }

    try {
        // SQL Query to insert into the customer contact consultant table
        $str_query = "  INSERT INTO tbl_cust_consult_contact (user_id, emp_id, msg_title, proj_id, time, status)
                        VALUES (:user_id, :emp_id, :msg_title, :proj_id, NOW(), 7);";
        $str_stmt = $r_Db->prepare($str_query);
        // bind paramenters, Named paramenters alaways start with colon(:)
        $str_stmt->bindParam(':user_id', $int_user);
        $str_stmt->bindParam(':emp_id', $int_emp);
        $str_stmt->bindParam(':msg_title', $str_msg_title);
        $str_stmt->bindParam(':proj_id', $int_msg_project);
        // For Executing prepared statement we will use below function
        $str_stmt->execute();
        $status = "success";    // This variable will be sent tback to the user profile page to enable the success display
    }   catch(PDOException $e)  {
        echo "Connection failed: " . $e->getMessage();
        $status = "fail";    // This variable will be sent back to the user profile page to enable the failure display
    }
    // Closing MySQL database connection   
    $r_Db = null;
    //  Redirect to the user profile page
    header("location:cli_cust_contact_consult.php?status=$status"); 





/*         // Sending Email to  Consultant
        $str_consultant_email = 'consultant@iwsystem.co.uk';	// Email Address of company  consultant
		$to = $str_consultant_email;
		$headers = "From: Web_Form";
		$headers .= "Reply-To: $str_consultant_email";
		$email_subject = "New Job Opportunity";
		$email_body = "You have received a new message from a prospect on ".date('l jS F Y h:i:s A'); ."\n".
		" Here are the details:\n".
		"Name: $str_cust_name \n ".
		"Company Name: $str_cust_company\n".
		"Email: $str_cust_email \n".
		"Phone: $int_cust_phone \n".
		"Country: $str_cust_country \n".
		"Service Interest: $str_cust_interest \n".
		"Project Description: $str_cust_description \n".;
		mail($to,$email_subject,$email_body,$headers);	//	PHP Mail function  for sending email*/


/*		// Sending Email to  Customer to acknowledge receipt of mail
		$to = $str_cust_email;
		$headers = "From: no_reply@iwsystem.co.uk";
		$headers .= "Reply-To: no_reply@iwsystem.co.uk";
		$email_subject = "Service Request Info Received!";
		$email_body = "You have requested information about our service on ".date('l jS F Y h:i:s A'); ."\n".
		" \nThank you for contacting us!\n".
		"\n This is to confirm we have received your message and one of our consultants will be in touch with you shortly to discuss your needs \n ".
		"\n Alternatively, you can also reach us by: \n".
		"Email: $str_consultant_email \n".
		"Skype: iw.system \n".
		"Twitter: @iw_system \n";
		mail($to,$email_subject,$email_body,$headers);	//	PHP Mail function  for sending email*/
		
    // Closing MySQL database connection   
    


/*echo "<span class=\"alert alert-success\" >Your message has been received. Thanks! Here is what you submitted:</span><br><br>";
echo "<stong>Name:</strong> ".$name."<br>";	
echo "<stong>Email:</strong> ".$email."<br>";	
echo "<stong>Message:</strong> ".$message."<br>";*/


?>




