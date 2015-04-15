<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Services | IW System | UK</title>
    <meta name="description" content="IW System Services. Web development business, delivering intelligent web developments, to small and medium sized businesses, smart web solutions, web apps, portals, ecommerce, online marketing How can the business help your business to grow.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
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
<body>

    <!--Header-->
    <?php include('tmpl/header.php');  ?>


    <section class="title">
        <div class="container">
            <div class="row-fluid">
                <div class="span6">
                    <h1>Services</h1>
                </div>
                <div class="span6">
                    <ul class="breadcrumb pull-right">
                        <li><a href="index.php">Home</a> <span class="divider">/</span></li>
                        <li class="active">Services</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- / .title -->       
    
    <section class="services">
        <div class="container">
            <div class="row-fluid">
                <div class="span4 service-box">
                    <div class="service-box-wrap center">
                        <i style="font-size: 48px" class="icon-globe icon-large"></i>
                        <p> </p>
                        <h4>Website Design &amp; Development</h4>
                        <p>We provide clients with quality Mobile Responsive designs. We do not only deliver quality designs, but we make sure that your website offers a good level of intelligence and usability to lead your customers to the correct location without much clicks...</p> 
                        <div class="overlay">
                            <div class="service-box-inner">
                                <h3><a href="website-des-and-dev.php">Click Here</a></h3>
                                <a class="preview" href="website-des-and-dev.php"><i class="icon-hand-up icon-medium"></i><br> To View more details</a>
                            </div> 
                        </div>
                    </div>
                </div><!-- Service One -->
                <div class="span4 service-box">
                    <div class="service-box-wrap center">
                        <i style="font-size: 48px" class="icon-cloud icon-large"></i>
                        <p> </p>
                        <h4>Web Application Development</h4>
                        <p>At IW System, we understannd the importance of working with apps. Businesses require customized apps to achieve its technical and administrative functions. We provide our clients with these web apps that are tailored for optimum performance...</p>
                        <div class="overlay"> 
                            <div class="service-box-inner">
                                <h3><a href="web-app-sys-dev.php">Click Here</a></h3>
                                <a class="preview" href="web-app-sys-dev.php"><i class="icon-hand-up icon-medium"></i><br> To View more details</a>
                            </div> 
                        </div>
                    </div>
                </div><!-- Service Two -->
                <div class="span4 service-box">
                    <div class="service-box-wrap center">
                        <i style="font-size: 48px" class="icon-shopping-cart icon-large"></i>
                        <p> </p>
                        <h4>E-commerce Solution</h4>
                        <p>No matter what you want to sell online - products / services; our experienced staff will assist you in launching &amp; maintaining an online shop to reach out to your potential customers, while providing smart shopping experience to keep them coming back...</p>
                        <div class="overlay"> 
                            <div class="service-box-inner">
                                <h3><a href="ecommerce.php">Click Here</a></h3>
                                <a class="preview" href="ecommerce.php"><i class="icon-hand-up icon-medium"></i><br> To View more details</a>
                            </div> 
                        </div>
                    </div>
                </div><!-- Service Three -->
            </div>
            <hr>
            <div class="row-fluid">
                <div class="span4 service-box">
                    <div class="service-box-wrap center"><br>
                        <i style="font-size: 48px" class="icon-group icon-large"></i>
                        <p> </p>
                        <h4>Portal &amp; Web Systems Development</h4>
                        <p>We analyse your daily business needs and develop a web platform where you can achieve, monitor and manage your resources including improving staff and customer relations. We have the right solution for any size of business, including yours...</p>
                        <div class="overlay"> 
                            <div class="service-box-inner">
                                <h3><a href="web-app-sys-dev.php">Click Here</a></h3>
                                <a class="preview" href="web-app-sys-dev.php"><i class="icon-hand-up icon-medium"></i><br> To View more details</a>
                            </div> 
                        </div>
                    </div>
                </div><!-- Service Two -->
                <div class="span4 service-box">
                    <div class="service-box-wrap center">
                        <i style="font-size: 48px" class="icon-envelope icon-large"></i>
                        <p> </p>
                        <h4>Digital Marketing &amp; SEO</h4>
                        <p>A business is successful when the desired customers are able to find it and access the services. We provide you with solutions that make you discoverable and also provide you with the right tools to reach out to your customers...</p>
                        <div class="overlay"> 
                            <div class="service-box-inner">
                                <h3><a href="digi-marketing.php">Click Here</a></h3>
                                <a class="preview" href="digi-marketing.php"><i class="icon-hand-up icon-medium"></i><br> To View more details</a>
                            </div> 
                        </div>
                    </div>
                </div><!-- Service Four -->
                <div class="span4 service-box">
                    <div class="service-box-wrap center"><br>
                        <i style="font-size: 48px" class="icon-desktop icon-large"></i>
                        <p> </p>
                        <h4>Content Management Systems</h4>
                        <p>We give our clients the opportunity to manage and administer their websites, while being able to update the contents of there site themselves. You don't need to be a computer developer, we use CMS to develop standard web systems that are easy to manage...</p>
                        <div class="overlay"> 
                            <div class="service-box-inner">
                                <h3><a href="content-mgt-sys.php">Click Here</a></h3>
                                <a class="preview" href="content-mgt-sys.php"><i class="icon-hand-up icon-medium"></i><br> To View more details</a>
                            </div> 
                        </div>
                    </div>
                </div><!-- Service Five -->
            </div>
            <hr>
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
            <div class="center">           
                <p>Do you want to know more details of what we can offer you <i class="icon-question"></i></p>
                <a data-toggle="modal" href="#consultant-contact" class="btn btn-success btn-large" title="Click for a Consultant">Speak to Our Consultants</a>
            </div>
            <p>&nbsp;</p>

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
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/wow.min.js"></script>

</body>
</html>
