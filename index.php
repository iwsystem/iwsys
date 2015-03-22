<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>IW System | Web Development UK</title>
    <meta name="description" content="Home page for IW System. Web development business, delivering intelligent web developments, to small and medium sized businesses, smart web solutions, web apps, portals, ecommerce, online marketing">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/sl-slide.css">
    <link rel="stylesheet" href="css/animate.css">
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
                        errorClass: "error_msg",    //  Define the class for the error message
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
    <!--Slider-->
    <section id="slide-show">
        <div id="slider" class="sl-slider-wrapper">
            <!--Slider Items-->    
            <div class="sl-slider">
                <!--Slider Item1-->
                <div class="sl-slide item1" data-orientation="horizontal">
                    <div class="sl-slide-inner">
                        <div class="container">
                            <h2 class="slide1">
                                <ul class="ad-head">
                                    <li>Intelligent Web Solutions</li>
                                    <li>Be Noticed Online</li>
                                    <li>Improved Management</li>
                                </ul>
                            </h2>
                            <h3 class="gap slide-desc">
                                <ul class="ad-desc">
                                    <li>For Your Business &amp; Personal Needs</li>
                                    <li>Win Attention of Your Customers</li>
                                    <li>Brilliant System Management Solutions</li>
                                </ul>
                            </h3>
                            <a class="btn btn-medium btn-black" href="services.php">What We Offer</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /slider-wrapper -->           
    </section>
    <!--/Slider-->
    <section class="main-info">
        <div class="container">
            <div class="row-fluid">
                <div class="span9">
                    <h3>Delivering Powerful and Affordable Web Solutions</h4>
                    <p class="no-margin">At IW System, we are here to enable your business achieve its goals. Our experts make it possible for you to establish and maintain the necessary web presence that you require, to distinguish you and / or your business. <i><a href="about-us.php">Find out who we are</a></i></p>
                    <br>
                    <p>We understand that small and medium sized businesses require intelligent web solutions to be able to stand up to the competition with the bigger names. We strive to provide you with quality which will attract and retain your customers. Better still, quite affordable. <i><a href="about-us.php">Get to know us</a></i> </p>
                </div>
                <div class="span3">
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
        </div>
    </section>
    <!--Services-->
    <section id="services">
        <div class="container">
            <div class="center gap">
                <h3>What We Offer</h3>
                <p class="lead">Our analysts and developers put in all efforts to tailor your idea into reality. In general, we offer these range of services</p>
            </div>
            <div class="row-fluid">
                <div class="span4">
                    <div class="media">
                        <div class="pull-left">
                            <i class="icon-globe icon-medium"></i>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading"><a href="website-des-and-dev.php">Website Development</a></h4>
                            <p>We provide clients with quality Mobile Responsive designs. We do not only deliver quality designs, but we make sure that your website offers a good level of intelligence and usability to lead your customers to the correct location without much clicks. <i><a href="website-des-and-dev.php">Find out more</a></i></p>
                        </div>
                    </div>
                </div>            

                <div class="span4">
                    <div class="media">
                        <div class="pull-left">
                            <i class="icon-cloud icon-medium"></i>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading"><a href="web-app-sys-dev.php">Web Application Development</a></h4>
                            <p>At IW System, we understannd the importance of working with apps. Businesses require customized apps to achieve its technical and administrative functions. We provide our clients with these web apps that are tailored for optimum performance. <i><a href="web-app-sys-dev.php">Find out more</a></i></p>
                        </div>
                    </div>
                </div>            

                <div class="span4">
                    <div class="media">
                        <div class="pull-left">
                            <i class="icon-group icon-medium icon-rounded"></i>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading"><a href="web-app-sys-dev.php"> Portal &amp; Web Systems Development</a></h4>
                            <p>We analyse your daily business needs and develop a web platform where you can achieve, monitor and manage your resources including improving staff and customer relations. We have the right solution for any size of business, including yours.. <i><a href="web-app-sys-dev.php">Find out more</a></i></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="gap"></div>
            <div class="row-fluid">
                <div class="span4">
                    <div class="media">
                        <div class="pull-left">
                            <i class="icon-shopping-cart icon-medium"></i>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading"><a href="ecommerce.php">E-commerce Solution</a></h4>
                            <p>No matter what you want to sell online - products / services; our experienced staff will assist you in launching &amp; maintaining an online shop to reach out to your potential customers, while providing smart shopping experience to keep them coming back. <i><a href="ecommerce.php">Find out more</a></i></p>
                        </div>
                    </div>
                </div>            

                <div class="span4">
                    <div class="media">
                        <div class="pull-left">
                            <i class="icon-envelope icon-medium"></i>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading"><a href="digi-marketing.php">Digital Marketing &amp; SEO</a></h4>
                            <p>A business is successful when the desired customers are able to find it and access the services. We provide you with solutions that make you discoverable and also provide you with the right tools to reach out to your customers. <i><a href="digi-marketing.php">Find out more</a></i></p>
                        </div>
                    </div>
                </div>            

                <div class="span4">
                    <div class="media">
                        <div class="pull-left">
                            <i class="icon-desktop icon-medium"></i>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading"><a href="content-mgt-sys.php">Content Management Systems</a></h4>
                            <p>We give our clients the opportunity to manage and administer their websites, while being able to update the contents of there site themselves. You don't need to be a computer developer, we use CMS to develop standard web systems that are easy to manage. <i><a href="content-mgt-sys.php">Find out more</a></i></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!--/Services-->
     <!--Technologies-->
    <section id="clients" class="main">
        <div class="container">
            <div class="row-fluid">
                <div class="span3">
                    <div class="clearfix">
                        <h4 class="pull-left">TECHNOLOGIES WE USE</h4>
                    </div>
                    <p>We adopt open source technologies and transform them into customized solutions to suit client demands</p>
                </div>
                <div class="span9">
                    <div id="myCarousel" class="carousel slide clients">
                        <!-- Carousel items -->
                        <div class="carousel-inner">
                            <div class="active item">
                                <div class="row-fluid">
                                    <ul class="thumbnails">
                                        <li class="span1"><img src="images/technologies/html5.gif" title="HTML5"></li>
                                        <li class="span1"><img src="images/technologies/css3.gif" title="CSS3"></li>
                                        <li class="span1"><img src="images/technologies/js.gif"  title="Javascript"></li>
                                        <li class="span1"><img src="images/technologies/php.gif"  title="PHP"></li>
                                        <li class="span1"><img src="images/technologies/mysql.gif" title="MySQL"></li>
                                        <li class="span3"><img src="images/technologies/jquery.gif" title="JQuery"></li>
                                        <li class="span3"><img src="images/technologies/jquery-ui.gif" title="JQuery UI"></li>
                                        <li class="span3"><img src="images/technologies/wordpress.gif" title="WordPress"></li>
                                        <li class="span3"><img src="images/technologies/drupal.gif"  title="Drupal"></li>
                                        <li class="span3"><img src="images/technologies/opencart.gif"  title="OpenCart"></li>
                                        <li class="span3"><img src="images/technologies/linux.gif" title="Linux"></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <!-- /Carousel items -->
                    </div>
                </div>
            </div>
        </div>
    </section>
     <!--/Technologies-->
    <!--Bottom-->
    <?php include('tmpl/bottom.php');  ?>

    <!--Footer-->
    <?php include('tmpl/footer.php');  ?>

    <!--  Login form -->
    <?php include('tmpl/login-form.php');  ?>
    <!-- javascript files and libraries -->
    <script src="js/vendor/bootstrap.min.js"></script>
    <script src="js/jquery.lettering.js"></script>
    <script src="js/jquery.textillate.js"></script>
    <script src="js/main.js"></script>
    <!-- Required javascript files for Slider -->
    <script src="js/jquery.ba-cond.min.js"></script>
    <script src="js/jquery.slitslider.js"></script>
    <script src="js/send_msg.js"></script>
    <!-- /Required javascript files for Slider -->
    <!-- SL Slider -->
    <script type="text/javascript"> 
        $(function() {
            var Page = (function() {

                var $navArrows = $( '#nav-arrows' ),
                slitslider = $( '#slider' ).slitslider( {
                    autoplay : true
                } ),

                init = function() {
                    initEvents();
                },
                initEvents = function() {
                    $navArrows.children( ':last' ).on( 'click', function() {
                        slitslider.next();
                        return false;
                    });

                    $navArrows.children( ':first' ).on( 'click', function() {
                        slitslider.previous();
                        return false;
                    });
                };

                return { init : init };

            })();

            Page.init();
        });
    </script>
    <!-- /SL Slider -->
    <!-- Textilate-->
    <script>
        $(function (){
            // Textify animation for the main header of slider
            $('.slide1')
                .textillate({ 
                    initialDelay: 500, 
                    minDisplayTime: 7000,
                    selector: '.ad-head',
                    in:     { 
                                effect: 'flipInY', 
                                delay:  30, 
                                delayScale:   2 
                            }, 
                    out:    {   effect: 'fadeOut', 
                                sync:   true, 
                                delay:  10, 
                                shuffle: true
                            }, 
                    loop: true 
                });
            // Textify animation for the description of the slider 
            $('.slide-desc')
                .textillate({ 
                    initialDelay: 500, 
                    minDisplayTime: 6500,
                    selector: '.ad-desc',
                    in:     { 
                                effect: 'flipInY', 
                                delay:  30, 
                                delayScale:   2 
                            }, 
                    out:    {   effect: 'fadeOut', 
                                sync:   true, 
                                delay:  10, 
                                shuffle: true
                            }, 
                    loop: true 
                });
        });
    </script>
    <!-- /Textilate-->
</body>
</html>