<?php
	include_once("signon/pdo-connect.php");
	include_once("mailer/class.phpmailer.php");
	include_once("mailer/class.smtp.php");

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

         //  Preparing PHP Mailer to forward the new message mail confirmation to the customer 
        $mail             = new PHPMailer();    // PHP Mailer Class
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Host       = "iwsystemcom.ipage.com";      // sets Ipage as the SMTP server
        $mail->Port       = 587;                   // set the SMTP port
        $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
        $mail->SMTPAuth   = true;                  // enable SMTP authentication
        $mail->Username   = "consultant@iwsystem.co.uk";  // GMAIL username
        $mail->Password   = "Chumasky2014&";            // GMAIL password, Some times if two step varification enabled in this mail id, Mail will not be sent.
        $mail->From       = "consultant@iwsystem.co.uk";
        $mail->FromName   = "IW System";
        $mail->addAddress("$str_cust_email", ucfirst($str_cust_name);
        $mail->addReplyTo("consultant@iwsystem.co.uk","Consultant");
        $mail->Subject    = "Thank you for contacting us - " . ucfirst($str_cust_name);
        $mail->AltBody    = "Hello " . ucfirst($str_cust_name) . ", Thank you for contacting us regarding our service. One of our consultants 
        will get in touch with you shortly to handle any query or questions you have. For the mean time, do not hesistate to visit our 
        website at www.iwsystem.co.uk to view all we can offer you. Thanks"; //Text Body
        $mail->IsHTML(true); // send as HTML
        $mail_body             = "Hello <b>" . ucfirst($str_cust_name) . ", </b><br><br>Thank you for contacting us regarding our service. <br>One of our consultants 
        will get in touch with you shortly to handle any query or questions you have. <br><br>For the mean time, do not hesistate to visit our 
        website at www.iwsystem.co.uk to view all we can offer you. <br><br><br>Thanks<br><br><br>Customer Representative<br><b>IW System</b>";
        //  Sending off the mail
        if(!$mail->Send()) {
          echo "Mailer Error: " . $mail->ErrorInfo;
        } 

        //  Preparing PHP Mailer to forward the new message mail confirmation to the consultant staff 
        $mail2             = new PHPMailer();    // PHP Mailer Class
        $mail2->isSMTP();
        $mail2->SMTPDebug = 0;
        $mail2->Host       = "iwsystemcom.ipage.com";      // sets Ipage as the SMTP server
        $mail2->Port       = 587;                   // set the SMTP port
        $mail2->SMTPSecure = "tls";                 // sets the prefix to the servier
        $mail2->SMTPAuth   = true;                  // enable SMTP authentication
        $mail2->Username   = "contact@iwsystem.co.uk";  // GMAIL username
        $mail2->Password   = "Chumasky2014&";            // GMAIL password, Some times if two step varification enabled in this mail id, Mail will not be sent.
        $mail2->From       = "donotreply@iwsystem.co.uk";
        $mail2->FromName   = "IW System";
        $mail2->addAddress("consultant@iwsystem.co.uk", "Consultant");
        $mail2->addReplyTo("donotreply@iwsystem.co.uk","Do Not Reply");
        $mail2->Subject    = "You have a new Message from - " . ucfirst($str_cust_name);
        $mail2->AltBody    = "Hi there, You have a new message from a client. The details are below: Customer Name: ". ucfirst($str_cust_name) . " Company: ". $str_cust_company . " Email: " . 
        					$str_cust_email . " Phone: " . $int_cust_phone . " Country: ". $str_cust_country ." Message Subject: " . $str_cust_subject . " Message Description:  " . $str_cust_message
        					. " . Please get in touch with the customer as soon as possible and update account portal accordingly. Thanks"; //Text Body
        $mail2->IsHTML(true); // send as HTML
        $mail2_body             = "Hi there, <br><br>You have a new message from a client. <br>The details are below: <<br><br><b>Customer Name:</b> ". ucfirst($str_cust_name) . " <br><b>Company: </b>". $str_cust_company ." <br><b>Email: </b>" . 
        					$str_cust_email . " <br><b>Phone: </b>" . $int_cust_phone . " <br><b>Country: </b>". $str_cust_country ." <br><b>Message Subject: </b>" . $str_cust_interest . " <br><b>Message Description:  </b>" . $str_cust_description
        					. " . <br><br>Please get in touch with the customer as soon as possible and update account portal accordingly. <br><br>Thanks"; 
        //  Sending off the mail
        if(!$mail2->Send()) {
          echo "Mailer Error: " . $mail2->ErrorInfo;
        } 

        echo 'success';
    }   catch(PDOException $e)  {
        echo "Connection failed: " . $e->getMessage();
    }
    $r_Db = null;

?>




