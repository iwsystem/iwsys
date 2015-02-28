<?php
	include_once("signon/pdo-connect.php");

    $str_cust_name = $_POST['consult_name']; // Variable for the name of the customer
    $str_cust_company = $_POST['consult_company']; // Variable for the company name of the customer
    $str_cust_email = $_POST['consult_email']; // Variable for the email of the customer
    $int_cust_phone = $_POST['consult_phone']; // Variable for the phone of the customer
    $str_cust_country = $_POST['consult_country']; // Variable for the country of the customer
    $str_cust_interest = $_POST['consult_interest']; // Variable for the service interest of the customer
    $str_cust_description = $_POST['consult_description']; // Variable for the description of the customer project

	//  Code to store the inputed data into th database table
    try {
        // We Will prepare SQL Query
        $str_query = "  INSERT INTO tbl_consult_contact (consult_name, consult_company, consult_email, consult_phone, consult_country, consult_interest,consult_description, contact_date, status)
                        VALUES (:consult_name, :consult_company, :consult_email, :consult_phone, :consult_country, :consult_interest, :consult_description, NOW(), 8);";
        $str_stmt = $r_Db->prepare($str_query);
        // bind paramenters, Named paramenters alaways start with colon(:)
        $str_stmt->bindParam(':consult_name', $str_cust_name);
        $str_stmt->bindParam(':consult_company', $str_cust_company);
        $str_stmt->bindParam(':consult_email', $str_cust_email);
        $str_stmt->bindParam(':consult_phone', $int_cust_phone);
        $str_stmt->bindParam(':consult_country', $str_cust_country);
        $str_stmt->bindParam(':consult_interest', $str_cust_interest);
        $str_stmt->bindParam(':consult_description', $str_cust_description);
        // For Executing prepared statement we will use below function
        $str_stmt->execute();
        echo 'success';
    }   catch(PDOException $e)  {
        echo "Connection failed: " . $e->getMessage();
    }
    $r_Db = null;
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




