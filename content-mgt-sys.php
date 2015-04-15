<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Content Mgt System |IWSystem | UK</title>
    <meta name="description" content="Develop Content Management Systems, WordPress, Drupal, Customized CMS. Blogs, News, Forums, Wiki.">
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
                <div class="span6">
                    <h1>Content Management System</h1>
                </div>
                <div class="span6">
                    <ul class="breadcrumb pull-right">
                        <li><a href="index.php">Home</a> <span class="divider">/</span></li>
                        <li><a href="services.php">Services</a> <span class="divider">/</span></li>
                        <li class="active">Content Management Systems</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- / .title -->   

    <section id="about-us" class="container main">
        <div class="row-fluid">
            <div class="span6">
                <p><b>Content Management Systems</b> enable website owners to manage and update their website themselves at their time, convenience and as need be. Here at IW System, we also believe in putting complete <b>control</b> in the hands of our client. You do not require web development knowledge in order to use the CMS systems that we deploy for you.</p>
                <p>The systems we use are so easy to learn and use.  In addition, we provide basic <b>training</b> to clients on how to use these systems.</p>
                <p>We utilize the reputable <b><a href='http://www.wordpress.com' title='Visit Wordpress official site'>Wordpress</a></b> and <b><a href='http://www.drupal.org' title='Visit Drupal official site'>Drupal</a></b> systems to create solid websites, web blogs, web catalogs, web calendar, web galleries, which allows the site owner to publish contents including articles, images, videos, response to blog comments  and also have the ability to add new web pages in your website without requiring the consultation of a web developer.</p>
                <p>This solution enables the site owner to <b>spend less</b> for their website upgrade and maintenance while giving you more <b>control</b> over your web resources.</p>
                <p><b>Remember</b>, our CMS solution provides you with similar features as our <a href='website-des-and-dev.php'>Web Design</a> and <a href='web-app-sys-dev.php'>Web System Development</a> packages, but in addition, allows you to be the administrator of your website.</p>
                <p>Click on the button on this page to contact our consultants and we will be glad to assist you all the way...</p>
            </div>
            <div class="span2"></div>
            <div class="span4">
                <div>
                    <img src="images/services/cms.jpg">
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
