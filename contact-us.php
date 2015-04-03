<!DOCTYPE html>
<html class="no-js"> 
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Contact | IW System | UK</title>
    <meta name="description" content="IW System Contact. Send message, call and chat with the customer service. ALways Available to sort out your needs">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="shortcut icon" href="images/ico/icon.ico">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/sl-slide.css">
    <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <script src="js/vendor/jquery-1.9.1.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
     <!-- Validation And Ajax sending -->
    <script type="text/javascript">
        (function($,W,D)
        {
            var VALID = {};
            VALID.UTIL =
            {
                myValid: function()
                {
                    //  Consultant form validation rules
                    $("#contact-consult").validate({
                        errorElement: "span",
                        errorClass: "error_msg", 
                        rules: {
                            consult_name: {required: true },
                            consult_email: {required: true, email: true },
                            consult_country: {required: true, minlength: 2, number: false},
                            consult_phone: {number: true},
                            consult_description: {required: true, minlength: 5}
                        },
                        messages: {
                            consult_name: {required: "Please type your name"},
                            consult_email: {required: "Please type email", number: "Must be a valid email"},
                            consult_country: {required: "Type your country", minlength: "Atleast 2 letters", number: "Country can't be a number"},
                            consult_phone: {number: "Should contain  only numbers"},
                            consult_description: {required: 'Please describe project', minlength: 'Atleast 5 letters'}
                        },
                        //  This function specifies what will happen after the validation is successful
                        submitHandler: function(form) {
                            $.ajax({
                                type: "POST",
                                url: "send-consultant.php", // Wherer to send the form
                                data: $('form.contact-consult').serialize(),
                                success: function(msg){
                                    $('form.contact-consult').hide();
                                    $("#consult_success_msg").show();
                                    
                                },
                                error: function(){
                                    $("#consult_error_msg").show();
                                }
                            });
                            return false;   // This is used to prevent the default action of the object, which in this case was the form sending data using html post  
                            form.preventDefault();
                        }
                    });
                    
                    //Customer Rep form validation rules
                    $("#contact-cust-rep").validate({
                        errorElement: "span",
                        errorClass: "error_msg", 
                        rules: {
                            cust_rep_name: {required: true },
                            cust_rep_email: {required: true, email: true },
                            cust_rep_phone: {number: true},
                            cust_rep_message: {required: true, minlength: 5}
                        },
                        messages: {
                            cust_rep_name: {required: "Please type your name"},
                            cust_rep_email: {required: "Please type email", number: "Must be a valid email"},
                            consult_phone: {number: "Should contain  only numbers"},
                            cust_rep_message: {required: 'Type you enquiry', minlength: 'Atleast 5 letters'}
                        },
                        //  This function specifies what will happen after the validation is successful
                        submitHandler: function(form) {
                            $.ajax({
                                type: "POST",
                                url: "send-cust-rep.php", // Where to send the form
                                data: $('form.contact-cust-rep').serialize(),
                                success: function(msg){
                                    $('form.contact-cust-rep').hide();
                                    $("#cust_rep_success_msg").show();
                                    
                                },
                                error: function(){
                                    $("#cust_rep_error_msg").show();
                                }
                            });
                            return false;   // This is used to prevent the default action of the object, which in this case was the form sending data using html post  
                        }
                    });
                }
            }
            //when the dom has loaded setup form validation rules
            $(D).ready(function($) {
                VALID.UTIL.myValid();
            });
        })(jQuery, window, document);
    </script>
    <!-- Changing the JQuery Validation Default Message -->
    <script>
        jQuery.extend(jQuery.validator.messages, {
            equalTo: "Please enter matchinhg email.",
            email: "Please enter a valid email."
        });
    </script>
</head>
<body>

    <!--Header-->
    <?php include('tmpl/header.php');  ?>
     <!-- End of Header-->
    <section id="contact-page" class="container">
        <div class="row center">
            <img src="images/contact-us.png">
        </div>
        <br>
        <div class="tab-wrap">
            <div class="well well-large">
                <h2>What would you want to speak to us about?</h2>
                <p>We are always here to render support and advise about our services. Click on any of the buttons below so we point you to the right direction</p>
                <!-- Modal for Customer Service contact -->
                <div id="cust-rep-contact" class="modal hide fade in" style="display: none;">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3>Get in touch with a Customer Service Rep</h3>
                        <span>Please fill in all sections marked *</span><BR><BR>
                        <div id="cust_rep_success_msg" class="hide center">
                            <span id="success_head" class="success_head">Message Sent!</span><br>
                            <span id="success_body" class="success_body">Thank you for getting in touch. We will contact you shortly</span>  
                        </div>
                        <div id="cust_rep_error_msg" class="hide center">
                            <span id="error_head" class="error_head">Oops! Message Not Sent!</span><br>
                            <span id="error_body" class="error_body">Sorry, something went wrong. Refresh page and try again.</span>
                        </div>
                    </div><br>
                    <div class="modal-body">
                        <form id="contact-cust-rep" class="contact-cust-rep" role="form" name ="contact-cust-rep" novalidate="novalidate">
                            <label class="label" for="cust_rep_name">Your Name *</label><br>
                            <div>
                                <input type="text" name="cust_rep_name" id="cust_rep_name" class="input-xlarge" placeholder="Your Name"><br> 
                            </div>
                            <label class="label" for="cust_rep_email">Your Email *</label><br>
                            <div>
                                <input type="text" name="cust_rep_email" id="cust_rep_email" class="input-xlarge" placeholder="Your Email"><br>
                            </div>
                            <label class="label" for="cust_rep_confirm_email">Confirm Email *</label><br>
                            <div>
                                <input type="text" name="cust_rep_confirm_email" id="cust_rep_confirm_email" class="input-xlarge required email" equalTo='#cust_rep_email' placeholder="Confirm Email"><br>
                            </div>
                            <label class="label" for="cust_rep_phone">Your Phone</label><br>
                            <div>
                                <input type="text" name="cust_rep_phone" id="cust_rep_phone" class="input-xlarge" placeholder="Your Phone"><br>
                            </div>
                            <label class="label" for="cust_rep_subject">Subject of Message</label><br>                            
                            <div>
                                <input type="text" name="cust_rep_subject" id="cust_rep_subject" class="input-xlarge" placeholder="Title / Subject of your query"><br>
                            </div>
                            <label class="label" for="cust_rep_message">Enter your Enquiry *</label><br>
                            <div>
                                <textarea name="cust_rep_message" id="cust_rep_message" class="input-xlarge" placeholder="Briefly tell us your enquiry..."></textarea>
                                <p>Maximum 500 characters</p>
                            </div>
                             <div class="modal-footer">
                                <input class="btn btn-success" type="submit" value="Send" id="submit_to_cust_rep">
                                <a href="#" class="btn" data-dismiss="modal">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- End of modal for Customer Service contact -->
                <!-- Modal for Consultant contact -->
                <div id="consultant-contact" class="modal hide fade in" style="display: none;">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3>Get in touch with a Consultant for a Quote</h3>
                        <span>Please fill in all sections marked *</span><br><br>
                        <div id="consult_success_msg" class="hide center">
                            <span id="success_head" class="success_head">Message Sent!</span><br>
                            <span id="success_body" class="success_body">One of Our Consultants will get intouch with you shortly</span>  
                        </div>
                        <div id="consult_error_msg" class="hide center">
                            <span id="error_head" class="error_head">Oops! Message Not Sent!</span>
                            <span id="error_body" class="error_body">Sorry, something went wrong. Refresh page and try again.</span>
                        </div>
                    </div><br>
                    <div class="modal-body">
                        <form id="contact-consult" class="contact-consult" role="form" name ="contact-consult" novalidate="novalidate">
                            <label class="label" for="consult_name">Your Name *</label><br>
                            <div>
                                <input type="text" name="consult_name" id="consult_name" class="input-xlarge" placeholder="Your Name"><br> 
                            </div>
                            <label class="label" for="consult_company">Your Company / Organization</label><br>
                            <div>
                                <input type="text" name="consult_company" id="consult_company" class="input-xlarge" placeholder="Your Company Name"><br>
                            </div>
                            <label class="label" for="consult_email">Your Email *</label><br>
                            <div>
                                <input type="text" name="consult_email" id="consult_email" class="input-xlarge" placeholder="Your Email"><br>
                            </div>
                            <label class="label" for="consult_confirm_email">Confirm Email *</label><br>
                            <div>
                                <input type="text" name="consult_confirm_email" id="consult_confirm_email" class="input-xlarge required email" equalTo='#consult_email' placeholder="Confirm Email"><br>
                            </div>
                            <label class="label" for="consult_phone">Your Phone</label><br>
                            <div>
                                <input type="text" name="consult_phone" id="consult_phone" class="input-xlarge" placeholder="Your Phone"><br>
                            </div>
                            <label class="label" for="consult_country">Your Country *</label><br>
                            <div>
                                <input type="text" name="consult_country" id="consult_country" class="input-xlarge" placeholder="Your Country"><br>
                            </div>
                            <label class="label" for="consult_interest">Which service are you interested in ?</label><br>
                            <div>
                                <!-- <input type="text" name="consult_interest" id="consult_interest" class="input-xlarge" placeholder="Which Services do You want"><br> -->
                                <select name="consult_interest" class="input-xLarge" id="consult_interest" >
                                    <option value="None">-- Services --</option>
                                    <option value="WebDesign">Website Design & Development</option>
                                    <option value="Web_App_AND_Sys_Dev">Web System / App Development </option>
                                    <option value="Ecommerce">E-commerce / Web Shop </option>
                                    <option value="CMS">Content Management System </option>
                                    <option value="Digital_Marketing">Online / Digital Marketing </option>
                                </select><br>
                            </div>
                            <label class="label" for="consult_description">Brief Project Description *</label><br>
                            <div>
                                <textarea name="consult_description" id="consult_description" class="input-xlarge" placeholder="Briefly tell us about your project ..."></textarea>
                                <p>Maximum 500 characters</p>
                            </div>
                            <div class="modal-footer">
                                <input class="btn btn-success" type="submit" value="Send" id="submit_to_consultant">
                                <a href="#" class="btn" data-dismiss="modal">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- End of modal for Consultant contact form -->
                <div id="thanks">
                        <div class="span4"><a data-toggle="modal" href="#cust-rep-contact" class="btn btn-success btn-large" title="Click for Customer Service">General Enquiries</a></div>
                        <div class="span2"></div>
                        <div class="span4"><a data-toggle="modal" href="#consultant-contact" class="btn btn-black btn-large pull-right" title="Click for a Consultant">Project Discussion</a></div>
                </div>
            </div>
        </div>
    </section>

    <!--Bottom-->
    <?php include('tmpl/bottom.php');  ?>

    <!--Footer-->
    <?php include('tmpl/footer.php');  ?>

    <!--  Login form -->
    <?php include('tmpl/login-form.php');  ?>

<script src="js/vendor/jquery-1.9.1.min.js"></script>
<script src="js/vendor/bootstrap.min.js"></script>
<script src="js/main.js"></script>   

</body>
</html>
