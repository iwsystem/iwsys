<?php 
include_once('signon/session.php');
include_once("signon/pdo-connect.php");
include_once("mailer/class.phpmailer.php");
include_once("mailer/class.smtp.php");

    
    $i_uEmail = $_SESSION["email"]; // This is the email of the signed on user
    //  Retrieving the variables sent by submitting  the user form
    $consult_name = strtolower($_POST['consult_name']); // Variable for the customer's name
    $consult_company = $_POST['consult_company']; // Variable for the customer's company
    $consult_country = $_POST['consult_country']; // Variable for the customer's country
    $consult_phone = $_POST['consult_phone']; // Variable for the customer's phone
    $consult_email = $_POST['consult_email']; // Variable for the customer's email
    $consult_interest = $_POST['consult_interest']; // Variable for the customer's subject
    $consult_description = $_POST['consult_description']; // Variable for the customer's message
    $consult_note = strtolower($_POST['consult_note']); // Variable for the notes by the customer rep staff
    $consult_outcome = $_POST['consult_outcome']; // Variable for the customer's outcome
    $contact_status = $_POST['status']; // Variable for the customer's phone

    //  Code to store the inputed data into th database table
    try {
        // We Will prepare SQL Query
        $str_query = "  INSERT INTO tbl_consult_contact (consult_name, consult_company, consult_email, consult_phone, consult_country, consult_interest, consult_description, consult_medium,  consult_note, consult_outcome, contact_date, status)
                        VALUES (:consult_name, :consult_company, :consult_email, :consult_phone, :consult_country, :consult_interest, :consult_description, 1, :consult_note, :consult_outcome, NOW(), :contact_status);";
        $str_stmt = $r_Db->prepare($str_query);
        // bind paramenters, Named paramenters alaways start with colon(:)
        $str_stmt->bindParam(':consult_name', $consult_name);
        $str_stmt->bindParam(':consult_company', $consult_company);
        $str_stmt->bindParam(':consult_email', $consult_email);
        $str_stmt->bindParam(':consult_phone', $consult_phone);
        $str_stmt->bindParam(':consult_country', $consult_country);
        $str_stmt->bindParam(':consult_interest', $consult_interest);
        $str_stmt->bindParam(':consult_description', $consult_description);
        $str_stmt->bindParam(':consult_note', $consult_note);
        $str_stmt->bindParam(':consult_outcome', $consult_outcome);
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
            $mail2->addReplyTo($i_uEmail,"Consultant");
            $mail2->Subject    = "New Customer- call : " . ucfirst($consult_name) . " Called ";
            $mail2->AltBody    = "Hi there, A new customer called in today that requires attention. The details are below: Customer Name: ". ucfirst($consult_name) . " Email: " . 
                                $consult_email . " Phone: " . $consult_phone ." Country: ". $consult_country . " Message Subject: " . ucfirst($consult_interest) . " Message Description:  " . $consult_description .  " Staff Note: " . $consult_note
                                . " . Please get in touch with the customer as soon as possible and update account portal accordingly. Thanks"; //Text Body
            $mail2->IsHTML(true); // send as HTML
            $mail2_body             = "Hi there, <br><br>A new customer called in today that requires attention. <br>The details are below: <br><br><b>Customer Name:</b> ". ucfirst($consult_name) . " <br><b>Email: </b>" . 
                                $consult_email . " <br><b>Phone: </b>" . $consult_phone . " <br><b>Country: </b>" . $consult_country . " <br><b>Message Subject: </b>" . ucfirst($consult_interest) . " <br><b>Message Description:  </b>" . $consult_description . " <br><b>Staff Note:  </b>" . $consult_note
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
    header("location:stf_cust_consult_phone_newCustomer.php?status=$status"); 

?>