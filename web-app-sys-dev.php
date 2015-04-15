<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Web App & System | IW System | UK</title>
    <meta name="description" content="Web Applications and Web System development page. Web Portals, ERP systems, CRM systems, Personnel Management System, Inventory Management System">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/sl-slide.css">
    <link rel ="shortcut icon" href="images/ico/icon.ico" />
    <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <script src="js/vendor/jquery-1.9.1.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/countries.js"></script>
     <!-- Validation And Ajax sending -->
    <script type="text/javascript">
        (function($,W,D)
        {
            var VALID = {};
            VALID.UTIL =
            {
                myValid: function()
                {
                    //form validation rules
                    $("#contact-consult").validate({
                        errorElement: "span",
                        errorClass: "error_msg", 
                        rules: {
                            consult_name: {required: true },
                            consult_email: {required: true, email: true },
                            consult_country: {required: true},
                            consult_phone: {number: true},
                            consult_description: {required: true, minlength: 5, maxlength: 500}
                        },
                        messages: {
                            consult_name: {required: "Please type your name"},
                            consult_email: {required: "Please type email", number: "Must be a valid email"},
                            consult_country: {required: "Select your country"},
                            consult_phone: {number: "Should contain  only numbers"},
                            consult_description: {required: 'Please describe project', minlength: 'Atleast 5 letters', maxlength: 'Not more tha 500 letters'}
                        },
                        //  This function specifies what will happen after the validation is successful
                        submitHandler: function(form) {
                            $.ajax({
                                type: "POST",
                                url: "send-consultant.php", // Wherer to send the form
                                data: $('form.contact-consult').serialize(),
                                beforeSend: function(){
                                    $('#consult-overlay').show();
                                },
                                complete: function(){
                                    $('#consult-overlay').hide();
                                },
                                success: function(msg){
                                    $('form.contact-consult').hide();
                                    $("#consult_success_msg").show();
                                    
                                },
                                error: function(){
                                    $('form.contact-consult').hide();
                                    $("#consult_error_msg").show();
                                }
                            });
                            return false;   // This is used to prevent the default action of the object, which in this case was the form sending data using html post  
                            form.preventDefault();
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

    <section class="title">
        <div class="container">
            <div class="row-fluid">
                <div class="span7">
                    <h1>Web App & System Development</h1>
                </div>
                <div class="span5">
                    <ul class="breadcrumb pull-right">
                        <li><a href="index.php">Home</a> <span class="divider">/</span></li>
                        <li><a href="services.php">Services</a> <span class="divider">/</span></li>
                        <li class="active">Web App & System Development</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- / .title -->   

    <section id="about-us" class="container main">
        <div class="row-fluid">
            <div class="span6">
                <p>In recent times, applications and softwares being used by individuals and businesses are gradually moving off from stand alone software installed on a single machine or laptop. Now, it is trending towards implementing all applications on the internet. Due to the universal and readily availability of the web, these applications now seem better deployed online making it always and easily accessible for you, your team and customers.</p>
                <p>At IW System, we develop and deploy <b>smart</b> web apps both adaptive and responsive for our clients' use and satisfaction.</p>
                <p>We develop web systems and portals that are proven to enable our clients achieve a successful business operation. Our web portal solution will help you <b>optimize</b> your work flow, logistics, human and material resource management by utilizing <b>simple</b> & clear design solutions where your staff and customers as well can login and gain access to loads of useful resources including but not limited to real-time inventory information, user access, administrative data, reports & analysis, inter / intra office communication. With the modern day massive amount of information available, whatever industry you operate in – manufacturing, health care, education, government, communications, agency or non-profit organization, an integrated web system for your business is of huge importance. </p>
                <p>What makes our solution stand out as intelligent is that we provide these solutions to be <b>affordable</b> and <b>cost effective</b> for <b>small</b> and <b>medium sized</b> businesses by tailoring your applications and system to the precise needs of your business and making it seamless to deploy and easy to learn by your team.</p>
                <p>Do you want a web system or application that conforms to your <b>standard</b> / improves your business's <b>efficiency</b> and readily available to you where ever you go? </p>
                <p>Do you already have a website or system for your business and need to step up to improve your business and have higher edge over your competitors?</p>
                <p>Give us a shout, we believe that we have the right solution for you...</p>
            </div>
            <div class="span2"></div>
            <div class="span4">
                <div class="gap"></div>
                <div>
                    <img src="images/services/web-apps.jpg" class="radial-image">
                </div>
                <!-- Modal for Consultant contact -->
                <div id="consultant-contact" class="modal hide fade in" style="display: none;">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3>Contact a Consultant for more discussion about your project</h3>
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
                            <label class="label" for="consult_country">Your Country*</label><br>
                            <div>
                                <select name="consult_country" id="consult_country" class="input-large"></select><br>
                                    <script language="javascript">
                                        populateCountries("consult_country");
                                    </script>
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
                    <div id="consult-overlay" class="hide"></div>
                </div>
                <!-- End of modal for Consultant contact form -->
                <br><br>
                <a data-toggle="modal" href="#consultant-contact" class="btn btn-success btn-large pull-right" title="Click for a Consultant">Speak to Our Consultants</a>
            </div>
        </div>
    </section>

    <!--Bottom-->
    <?php include('tmpl/bottom.php');  ?>

    <!--Footer-->
    <?php include('tmpl/footer.php');  ?>

    <!--  Login form -->
    <?php include('tmpl/login-form.php');  ?>

    <script src="js/vendor/bootstrap.min.js"></script>
    <script src="js/bootstrap-hover-dropdown.min.js"></script>
    <script src="js/main.js"></script>

</body>
</html>
