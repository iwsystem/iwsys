<?php
	include_once("signon/pdo-connect.php");
	include_once("mailer/class.phpmailer.php");
	include_once("mailer/class.smtp.php");

    $str_cust_name = $_POST['cust_rep_name']; // Variable for the name of the customer
    $str_cust_email = $_POST['cust_rep_email']; // Variable for the email of the customer
    $int_cust_phone = $_POST['cust_rep_phone']; // Variable for the phone of the customer
    $str_cust_subject = $_POST['cust_rep_subject']; // Variable for the subject of enquiry of the customer
    $str_cust_message = $_POST['cust_rep_message']; // Variable for the enquiry of the customer

	//  Code to store the inputed data into th database table
    try {
        // We Will prepare SQL Query
        $str_query = "  INSERT INTO tbl_cust_rep_contact (cust_name, cust_email, cust_phone, cust_subject, cust_message, contact_date, status)
                        VALUES (:cust_name, :cust_email, :cust_phone, :cust_subject, :cust_message, NOW(), 8);";
        $str_stmt = $r_Db->prepare($str_query);
        // bind paramenters, Named paramenters alaways start with colon(:)
        $str_stmt->bindParam(':cust_name', $str_cust_name);
        $str_stmt->bindParam(':cust_email', $str_cust_email);
        $str_stmt->bindParam(':cust_phone', $int_cust_phone);
        $str_stmt->bindParam(':cust_subject', $str_cust_subject);
        $str_stmt->bindParam(':cust_message', $str_cust_message);
        // For Executing prepared statement we will use below function
        $str_stmt->execute();

        //  Preparing PHP Mailer to forward the new message mail confirmation to the customer rep staff 
        $mail2             = new PHPMailer();    // PHP Mailer Class
        $mail2->isSMTP();
        $mail2->SMTPDebug = 0;
        $mail2->Host       = "iwsystemcom.ipage.com";      // sets Ipage as the SMTP server
        $mail2->Port       = 587;                   // set the SMTP port
        $mail2->SMTPSecure = "tls";                 // sets the prefix to the servier
        $mail2->SMTPAuth   = true;                  // enable SMTP authentication
        $mail2->Username   = "consultant@iwsystem.co.uk";  // GMAIL username
        $mail2->Password   = "Chumasky2014&";            // GMAIL password, Some times if two step varification enabled in this mail id, Mail will not be sent.
        $mail2->From       = "consultant@iwsystem.co.uk";
        $mail2->FromName   = "IW System";
        $mail2->addAddress("contact@iwsystem.co.uk", "Customer Rep");
        $mail2->addReplyTo("admin@iwsystem.co.uk","Do Not Reply");
        $mail2->Subject    = "You have a new Message from - " . ucfirst($str_cust_name);
        $mail2->AltBody    = "Hi there, You have a new message from a client. The details are below: Customer Name: ". ucfirst($str_cust_name) . " Email: " . 
        					$str_cust_email . " Phone: " . $int_cust_phone . " Message Subject: " . ucfirst($str_cust_subject) . " Message Description:  " . $str_cust_message
        					. " . Please get in touch with the customer as soon as possible and update account portal accordingly. Thanks"; //Text Body
        $mail2->IsHTML(true); // send as HTML
        $mail2_body             = "Hi there, <br><br>You have a new message from a client. <br>The details are below: <br><br><b>Customer Name:</b> ". ucfirst($str_cust_name) . " <br><b>Email: </b>" . 
        					$str_cust_email . " <br><b>Phone: </b>" . $int_cust_phone . " <br><b>Message Subject: </b>" . ucfirst($str_cust_subject) . " <br><b>Message Description:  </b>" . $str_cust_message
        					. " . <br><br>Please get in touch with the customer as soon as possible and update account portal accordingly. <br><br>Thanks"; 
        $mail2->msgHTML($mail2_body);
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




