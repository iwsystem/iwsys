<?php 
include_once('signon/session.php');
include_once("signon/pdo-connect.php");

    $i_uID = $_SESSION["user_id"]; // This is the id of the user
    //  Retrieving the variables sent by submitting  the update form
    $user_type = $_POST['user_type']; // Variable for the first name
    $first_name = strtolower($_POST['first_name']); // Variable for the first name
    $last_name = strtolower($_POST['last_name']); // Variable for the last name
    $email = $_POST['email']; // Variable for the email
    $phone = $_POST['phone']; // Variable for the phone
    $address1 = strtolower($_POST['address1']); // Variable for asddress line 1
    $address2 = strtolower($_POST['address2']); // Variable for the address line 2
    $city = strtolower($_POST['city']); // Variable for the city
    $state_county = strtolower($_POST['state_county']); // Variable for the state / county
    $postcode = $_POST['postcode']; // Variable for the postcode
    $country = strtolower($_POST['country']); // Variable for the country
    $username = $first_name[0].$last_name.mt_rand(1, 9).mt_rand(15, 150);       // Generating random username using the user's first name and last name combination
    $password = $first_name[0].$first_name[1].$last_name[0].$last_name[1].mt_rand(1022, 30223); // Generating random password using the user's first name and last name combination

    //  Code to store the inputed data into the user table
    try {
        // We Will prepare SQL Query
        $str_query = "  INSERT INTO tbl_user (firstname, lastname, email, phone, address1, address2, city, state_county, postcode, country, user_type, username, password, created, status )
                        VALUES (:firstname, :lastname, :email, :phone, :address1, :address2, :city, :state_county, :postcode, :country, :user_type, :username, :password, NOW(), 7);";
        $str_stmt = $r_Db->prepare($str_query);
        // bind paramenters, Named paramenters alaways start with colon(:)
        $str_stmt->bindParam(':firstname', $first_name);
        $str_stmt->bindParam(':lastname', $last_name);
        $str_stmt->bindParam(':email', $email);
        $str_stmt->bindParam(':phone', $phone);
        $str_stmt->bindParam(':address1', $address1);
        $str_stmt->bindParam(':address2', $address2);
        $str_stmt->bindParam(':city', $city);
        $str_stmt->bindParam(':state_county', $state_county);
        $str_stmt->bindParam(':postcode', $postcode);
        $str_stmt->bindParam(':country', $country);
        $str_stmt->bindParam(':user_type', $user_type);
        $str_stmt->bindParam(':username', $username);
        $str_stmt->bindParam(':password', $password);
        // For Executing prepared statement we will use below function
        $str_stmt->execute();
        $eUserID = $r_Db->lastInsertId();  // Variable for the id of the previously inserted user  

        //  Check if the user is employee and set variable for role and Job Position, then update employee table
        if ($user_type == 1) {  //  Checking if the user is an employee
            $role = $_POST['role']; // Variable for the Role of staff 
            $job_position = strtolower($_POST['job_title']); // Variable for the first name

            $str_query = "  INSERT INTO tbl_employee (user_id, job_position, role_id)
                            VALUES (:user_id, :job_position, :role_id);";
            $str_stmt = $r_Db->prepare($str_query);
            // bind paramenters, Named paramenters alaways start with colon(:)
            $str_stmt->bindParam(':user_id', $eUserID);
            $str_stmt->bindParam(':job_position', $job_position);
            $str_stmt->bindParam(':role_id', $role);
            // For Executing prepared statement we will use below function
            $str_stmt->execute();
        }
        $status = "success";    // This variable will be sent back to the user profile page to enable the success display
    }   catch(PDOException $e)  {
        echo "Connection failed: " . $e->getMessage();
        $status = "fail";    // This variable will be sent back to the user profile page to enable the failure display
    }
    // Closing MySQL database connection   
    $r_Db = null;
    //  Redirect to the user profile page
    header("location:stf_user_admin_new.php?status=$status"); 
?>
