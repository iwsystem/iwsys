<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Web Design & Dev | IW System | UK</title>
    <meta name="description" content="Website design and development page. ">
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
                }
            }

            //when the dom has loaded setup form validation rules
            $(D).ready(function($) {
                VALID.UTIL.myValid();
            });

        })(jQuery, window, document);
    </script>
</head>
<body>

    <!--Header-->
    <?php include('tmpl/header.php');  ?>

    <section class="title">
        <div class="container">
            <div class="row-fluid">
                <div class="span6">
                    <h1>Web Design & Development</h1>
                </div>
                <div class="span6">
                    <ul class="breadcrumb pull-right">
                        <li><a href="index.php">Home</a> <span class="divider">/</span></li>
                        <li><a href="services.php">Services</a> <span class="divider">/</span></li>
                        <li class="active">Website Design & Development</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- / .title -->   

    <section id="about-us" class="container main">
        <div class="row-fluid">
            <div class="span6">
                <p>A <b>beautiful</b> design and good <b>user experience</b> surely attracts the eye which includes the eye of customers. We provide you with websites that your customers will love to revisit often.</p>
                <p><b>Interactivity</b> is key and being able to engage with your customers and intended audience is one of our priority because it is only with proper interaction can you win the consent of your clients. We plug into your websites, different possible means for you to reach out and be reached including multiple email accounts, online chat applications, video conferencing and sms notification solutions.</p>
                <p><b>Mobile responsive</b> and adaptive websites are very important for this present generation websites. Nowadays, most people browse the internet on the go using smart phones and tablets of different sizes and shapes. To make sure your customers can easily access your contents and communicate through your website on mobile devices, we make sure that equally, all our web development solutions adapt to different sizes of mobile phones and tablets, in order to keep your customers continuously impressed with your websites even while on the road.</p>
                <p><b>Website monitoring</b> and <b>performance analysis</b> is really important to any business, to determine your customer outreach and assist you in making decisions on the improvements to make so you get more people calling you immediately after visiting your website. With IW System solutions, we will empower you with this information and you can determine <b>whom</b> your visitors are, <b>where</b> they are in the world and <b>which</b> pages attract them the most.</p>
                <p>We maintain and administer these websites for our customers that have no technical  experience. Being very flexible, we also leave the room for our clients to take complete control and administration of their websites. <i><a href='content-mgt-sys.php'>Click here</a></i> to visit our <b>Content Management Systems</b> page to learn more about this solution.</p>
                <p><b>Remember!</b> All our solutions are tailored to your needs and budget. We will make sure you don't break the bank to get your well deserved web presence / project to go live.</p>
            </div>
            <div class="span2"></div>
            <div class="span4">
                <div class="gap"></div>
                <div>
                    <img src="images/services/web-design.jpg">
                </div>
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
                            <span id="error_head" class="error_head">Oops! Message Not Sent!</span><br>
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
                                <textarea name="consult_description" id="consult_description" class="input-xlarge" placeholder="Briefly tell us about your project..."></textarea>
                                <p>Maximum 500 characters</p>
                            </div><br>
                            <div class="modal-footer">
                                <input class="btn btn-success" type="submit" value="Send" id="submit_to_consultant">
                                <a href="#" class="btn" data-dismiss="modal">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- End of modal for Consultant contact form -->
                <br><br>
                    <a data-toggle="modal" href="#consultant-contact" class="btn btn-success btn-large pull-right" title="Click for a Consultant">Speak to Our Consultants</a>
            </div>
        </div>

        <hr>
    </section>

    <!--Bottom-->
    <?php include('tmpl/bottom.php');  ?>

    <!--Footer-->
    <?php include('tmpl/footer.php');  ?>

    <!--  Login form -->
    <?php include('tmpl/login-form.php');  ?>

    <script src="js/vendor/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

</body>
</html>
