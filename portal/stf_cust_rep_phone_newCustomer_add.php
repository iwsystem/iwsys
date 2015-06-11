<?php 
include_once('signon/session.php');
include_once("signon/pdo-connect.php");
include_once("mailer/class.phpmailer.php");
include_once("mailer/class.smtp.php");

    
    $i_uEmail = $_SESSION["email"]; // This is the email of the signed on user
    //  Retrieving the variables sent by submitting  the user form
    $cust_name = strtolower($_POST['cust_name']); // Variable for the customer's name
    $cust_company = $_POST['cust_company']; // Variable for the customer's company
    $cust_country = $_POST['cust_country']; // Variable for the customer's country
    $cust_phone = $_POST['cust_phone']; // Variable for the customer's phone
    $cust_email = $_POST['cust_email']; // Variable for the customer's email
    $cust_subject = $_POST['cust_subject']; // Variable for the customer's subject
    $cust_message = $_POST['cust_message']; // Variable for the customer's message
    $cust_note = strtolower($_POST['cust_note']); // Variable for the notes by the customer rep staff
    $contact_status = $_POST['status']; // Variable for the customer's phone

    //  Code to store the inputed data into th database table
    try {
        // We Will prepare SQL Query
        $str_query = "  INSERT INTO tbl_cust_rep_contact (cust_name, cust_company, cust_email, cust_phone, cust_country, cust_subject, cust_message, cust_medium, contact_date, cust_note, status)
                        VALUES (:cust_name, :cust_company, :cust_email, :cust_phone, :cust_country, :cust_subject, :cust_message, 1, NOW(), :cust_note, :contact_status);";
        $str_stmt = $r_Db->prepare($str_query);
        // bind paramenters, Named paramenters alaways start with colon(:)
        $str_stmt->bindParam(':cust_name', $cust_name);
        $str_stmt->bindParam(':cust_company', $cust_company);
        $str_stmt->bindParam(':cust_email', $cust_email);
        $str_stmt->bindParam(':cust_phone', $cust_phone);
        $str_stmt->bindParam(':cust_country', $cust_country);
        $str_stmt->bindParam(':cust_subject', $cust_subject);
        $str_stmt->bindParam(':cust_message', $cust_message);
        $str_stmt->bindParam(':cust_note', $cust_note);
        $str_stmt->bindParam(':contact_status', $contact_status);
        // For Executing prepared statement we will use below function
        $str_stmt->execute();
        if ($contact_status == 8) {
            //  Preparing PHP Mailer to forward the new message mail confirmation to the customer rep staff 
            $mail2             = new PHPMailer();    // PHP Mailer Class
            $mail2->isSMTP();
            $mail2->SMTPDebug = 0;
            $mail2->Host       = "mail.iwhosting.org";      // sets Ipage as the SMTP server
            $mail2->Port       = 2525;                   // set the SMTP port
            $mail2->SMTPSecure = "none";                 // sets the prefix to the servier
            $mail2->SMTPAuth   = true;                  // enable SMTP authentication
            $mail2->Username   = "contact@iwsystem.co.uk";  // GMAIL username
            $mail2->Password   = "Chumasky2014&";            // GMAIL password, Some times if two step varification enabled in this mail id, Mail will not be sent.
            $mail2->From       = $i_uEmail;
            $mail2->FromName   = "IW System";
            $mail2->addAddress("consultant@iwsystem.co.uk", "Consultant");
            $mail2->addReplyTo($i_uEmail,"Customer Rep");
            $mail2->Subject    = "New Customer- call : " . ucfirst($cust_name) . " Called ";
            $mail2->AltBody    = "Hi there, A new customer called in today that requires attention. The details are below: Customer Name: ". ucfirst($cust_name) . " Email: " . 
                                $cust_email . " Phone: " . $cust_phone ." Country: ". $cust_country . " Message Subject: " . ucfirst($cust_subject) . " Message Description:  " . $cust_message .  " Staff Note: " . $cust_note
                                . " . Please get in touch with the customer as soon as possible and update account portal accordingly. Thanks"; //Text Body
            $mail2->IsHTML(true); // send as HTML
            $mail2_body             = "Hi there, <br><br>A new customer called in today that requires attention. <br>The details are below: <br><br><b>Customer Name:</b> ". ucfirst($cust_name) . " <br><b>Email: </b>" . 
                                $cust_email . " <br><b>Phone: </b>" . $cust_phone . " <br><b>Country: </b>" . $cust_country . " <br><b>Message Subject: </b>" . ucfirst($cust_subject) . " <br><b>Message Description:  </b>" . $cust_message . " <br><b>Staff Note:  </b>" . $cust_note
                                . " . <br><br>Please get in touch with the customer as soon as possible and update account portal accordingly. <br><br>Thanks"; 
            $mail2->msgHTML($mail2_body);
            //  Sending off the mail
            if(!$mail2->Send()) {
              echo "Mailer Error: " . $mail2->ErrorInfo;
            }    
        }

        $status = "success";    // This variable will be sent back to the user profile page to enable the success display
    }   catch(PDOException $e)  {
        echo "Connection failed: " . $e->getMessage();
        $status = "fail";    // This variable will be sent back to the user profile page to enable the success display
    }
    $r_Db = null;
    //  Redirect to the user profile page
    header("location:stf_cust_rep_phone_newCustomer.php?status=$status"); 

?>