<?php
ob_start();

$dbUsername = "ryanc_admin";
$dbPassword = ";m^T3)=.Ls5=";
$selectedDatabase = "ryanc_admin";

$connect = mysql_connect("localhost", $dbUsername, $dbPassword) or die(mysql_error());
mysql_select_db("ryanc_admin");

// Log Visit

function recordVisit() {
    $websiteTag = "portfolio";
    $bot = 'false';

    if (preg_match('/bot|crawl|curl|dataprovider|search|get|spider|find|java|majesticsEO|google|yahoo|teoma|contaxe|yandex|libwww-perl|facebookexternalhit/i', $_SERVER['HTTP_USER_AGENT'])) {
        $bot = 'true';
    }

    mysql_query("INSERT INTO `admin.pagevisits` (page, ip, timestamp, website_tag, bot) VALUES('".$_SERVER['PHP_SELF']."','".$_SERVER['REMOTE_ADDR']."','".time()."', '$websiteTag', '$bot')");
}

function FetchGlobalBanList() {
    $getBans = mysql_query("SELECT * FROM `admin.globalbans` WHERE `active`='0' AND `ip`='".$_SERVER['REMOTE_ADDR']."'");
    $banInfo = mysql_fetch_object($getBans);

    if(mysql_num_rows($getBans) != 0) {
        if(time() < $banInfo->unban_date) {
            die("Error 403: Access Denied");
        } else {
            mysql_query("UPDATE `admin.globalbans` SET `active`='1' WHERE `id`='$banInfo->id'");
        }
    }
}

FetchGlobalBanList();
recordVisit();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Ryan Coulson - developer, student, music enthusiast</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="stylesheet.css" />
        <script src="https://use.fontawesome.com/b9fdb61c6c.js"></script>
        <link rel="shortcut icon" type="image/png" href="../images/ryan-coulson-logo3.png"/>
        <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>


        <script>
            jQuery(document).ready(function($) {
                $(".scroll").click(function(event){
                    event.preventDefault();
                    $('html,body').animate({scrollTop:$(this.hash).offset().top}, 1000);
                });
                $(".project-btn").click(function() {
                    window.location = $(this).data("href");
                });
            });
        </script>
        
    </head>
    <body data-spy="scroll">
        <nav class="navbar navbar-expand-lg sticky-top navbar-dark" id="navbar" style="background-color: #111; opacity: 0.9;">
            <a class="navbar-brand scroll" href="#top">
                <img src="../images/ryan-coulson-logo3.png" height="40" width="40" class="d-inline-block align-top" alt=""> 
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                 <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item custom-link-width">
                        <a class="nav-link scroll" href="#home">Home</a>
                    </li>
                    <li class="nav-item custom-link-width">
                        <a class="nav-link scroll" href="#about-me">About Me</a>
                    </li>
                    <li class="nav-item custom-link-width">
                        <a class="nav-link scroll" href="#projects">My Projects</a>
                    </li>
                    <li class="nav-item custom-link-width">
                        <a class="nav-link scroll" href="#contact">Get in Touch</a>
                    </li>
                    <li class="nav-item custom-link-width">
                        <a class="nav-link" target="_NEW" href="/blog/">Blog</a>
                    </li>
                </ul>
            </div>
        </nav>
        <section id="top"></section>
        <div class="header" id="home">
            <div class="custom-jumbotron">
                <span class="header-text">Ryan Coulson</span><br />
                <span class="outro-text">student &nbsp; // &nbsp; programmer &nbsp; // &nbsp; music enthusiast</span>
            </div>
        </div>
        <section class="custom-about" id="about-me">
            <div class="container">
                <h1 class="custom-header">About Me</h1>
                
                <div class="row">
                    <div class="col-md-8 custom-bio">
                        <h2>Who am I?</h2>
                        Hey, I'm Ryan.<br /><br />

                        <p>I am a computer programmer based in Ontario, Canada who loves to create websites and new software in my free time. I started programming back in 2006, and I'm still going strong to this day. I am currently working towards a Bachelor of Science in Computer Science at the University of Toronto.</p>

                        <p>I enjoy working on projects where I can make the most of my creativity and problem solving skills. </p>
                        <br />

                        <h2>What do I know?</h2>

                        <p>In terms of writing code, I've worked with all of the following: C, Java, Python, PHP, Assembly, HTML5, CSS3, JavaScript, and MySQL Database</p>
                        <p>Software I am fluent in includes: Microsoft Office Suite, Adobe Suite, PyCharm, IDLE, Eclipse, IntelliJ, Sublime Text 3, both Windows and Linux command shells, and the Git version control system (both through command line and Github).</p>
                    </div>
                    <div class="col-md-4 custom-about-border">
                        <h2>My Interests</h2>

                        <span class="fa-stack fa-lg custom-interests" style="font-size: 36px;">
                          <i class="fa fa-headphones fa-stack-1x"></i>
                        </span>
                        
                        <h3 class="custom-h3">music</h3>
                        <p class="custom-subtext">From simply listening, to producing and mixing my own; music plays a huge role in my life.</p>


                        <span class="fa-stack fa-lg custom-interests" style="font-size: 36px;">
                          <i class="fa fa-television fa-stack-1x"></i>
                        </span>
                        
                        <h3 class="custom-h3">television</h3>
                        <p class="custom-subtext">I enjoy watching television series such as HBO's Silicon Valley and Game of Thrones.</p>


                        <span class="fa-stack fa-lg custom-interests" style="font-size: 36px;">
                          <i class="fa fa-terminal fa-stack-1x"></i>
                        </span>
                        
                        <h3 class="custom-h3">coding</h3>
                        <p class="custom-subtext">I've been building websites since I was 8 years old. I still love everything about it.</p>

                        <span class="fa-stack fa-lg custom-interests" style="font-size: 36px;">
                          <i class="fa fa-gamepad fa-stack-1x"></i>
                        </span>
                        
                        <h3 class="custom-h3">gaming</h3>
                        <p class="custom-subtext">During my free time, I like to play both casual and competitive video games.</p>
                    </div>
                </div>
            </div>
        </section>

        <link rel="stylesheet" type="text/css" href="slick.css"/>
        <link rel="stylesheet" type="text/css" href="slick-theme.css"/>


        <section class="custom-portfolio" id="projects">
            <div class="container portfolio-cont">
                <h1 class="custom-header" style="padding-bottom: 0px;">My Projects</h1>

                <!-- PILLS
                                <span class="badge badge-pill custom-badge badge-green">Java</span>
                                <span class="badge badge-pill custom-badge badge-red">C</span>
                                <span class="badge badge-pill custom-badge badge-blue">HTML5</span>
                                <span class="badge badge-pill custom-badge badge-pink">CSS3</span>
                                <span class="badge badge-pill custom-badge badge-orange">PHP</span>
                                <span class="badge badge-pill custom-badge badge-cyan">XML</span>
                                <span class="badge badge-pill custom-badge badge-purple">MySQL</span>
                                <span class="badge badge-pill custom-badge badge-blue2">JavaScript</span>
                                <span class="badge badge-pill custom-badge badge-red2">jQuery</span>
                -->

                <!-- jumbo projects -->
                <div class="row">
                    <div class="col-sm">
                        <div class="project-data" style="color: purple;">SIDE PROJECT</div>
                        <div class="project-image-lg">
                            <img src="images/rcnotify-site2.png" />
                        </div>
                        <div class="project-body">
                            <b>RCNotify Mobile</b>RCNotify is an app for Android that allows you to keep track of your upcoming tasks and events. Categorize your tasks through topics and never forget what you need to do ever again.

                            <div class="badge-section">
                                <span class="badge badge-pill custom-badge badge-green">Java</span>
                                <span class="badge badge-pill custom-badge badge-orange">PHP</span>
                                <span class="badge badge-pill custom-badge badge-purple">MySQL</span>
                                <span class="badge badge-pill custom-badge badge-cyan">XML</span>
                            </div>
                        </div>
                        <div class="row project-btn-cont">
                                <div class="col-sm project-btn btn-salmon" data-href="/blog/2/">Read Blog Post</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="project-data" style="color: green;">COMMISSIONED</div>
                        <div class="project-image-lg">
                            <img src="images/berniej3.jpg" />
                        </div>
                        <div class="project-body">
                            <b>berniejessome.ca</b>This website was created as a paid assignment from my grandfather. The template was purchased from a third party, and then back/front-end modifications were done by me.

                            <div class="badge-section">
                                <span class="badge badge-pill custom-badge badge-blue">HTML5</span>
                                <span class="badge badge-pill custom-badge badge-pink">CSS3</span>
                                <span class="badge badge-pill custom-badge badge-blue2">JavaScript</span>
                                <span class="badge badge-pill custom-badge badge-orange">PHP</span>
                                <span class="badge badge-pill custom-badge badge-purple">MySQL</span>
                            </div>
                        </div>
                        <div class="row project-btn-cont">
                                <div class="col-sm project-btn btn-blue" data-href="http://berniejessome.ca/">Preview</div>
                        </div>
                    </div>
                </div>  

                <!-- other projects -->
                <div class="row">
                    <div class="col-sm">
                        <div class="project-data" style="color: purple;">SIDE PROJECT</div>
                        <div class="project-image">
                            <img src="images/rcnotifyweb-site3.png" />
                        </div>
                        <div class="project-body">
                            <b>RCNotify Web</b>RCNotify is the web-based version of RCNotify Mobile. The web version includes a navigation system that allows you to get to your favourite websites with ease.

                            <div class="badge-section">
                                <span class="badge badge-pill custom-badge badge-blue">HTML5</span>
                                <span class="badge badge-pill custom-badge badge-pink">CSS3</span>
                                <span class="badge badge-pill custom-badge badge-orange">PHP</span>
                                <span class="badge badge-pill custom-badge badge-purple">MySQL</span>
                                <span class="badge badge-pill custom-badge badge-blue2">JavaScript</span>
                                <span class="badge badge-pill custom-badge badge-red2">jQuery</span>
                            </div>
                        </div>
                        <div class="row project-btn-cont">
                                <div class="col-sm project-btn btn-blue" data-href="http://ryan-coulson.com/homepage/demo.php">Preview</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="project-data" style="color: red;">ASSIGNMENT</div>
                        <div class="project-image">
                            <img src="images/paintprogram2.png" />
                        </div>
                        <div class="project-body">
                            <b>Paint</b>This application was created as an assignment for one of my software development courses. It features many different Java design patterns and utilises the MVC framework.

                            <div class="badge-section">
                                <span class="badge badge-pill custom-badge badge-green">Java</span>
                            </div>
                        </div>
                        <div class="row project-btn-cont">
                                <div class="col-sm project-btn btn-purple" data-href="#contact">Contact Me</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="project-data" style="color: purple;">SIDE PROJECT</div>
                        <div class="project-image">
                            <img src="images/filesearch2.png" />
                        </div>
                        <div class="project-body">
                            <b>File Search</b>Given a file directory, this application will search through all the files and search for keywords that you supply it. This application makes use of Java design patterns and recursion.

                            <div class="badge-section">
                                <span class="badge badge-pill custom-badge badge-green">Java</span>
                            </div>
                        </div>
                        <div class="row project-btn-cont">
                                <div class="col-sm project-btn btn-blue" data-href="https://github.com/RyanCoulsonCA/FileSearch">Preview</div>
                        </div>
                    </div>
                </div>  

                <div class="row">
                    <div class="col-sm">
                        <div class="project-data" style="color: purple;">SIDE PROJECT</div>
                        <div class="project-image">
                            <img src="images/monopolydeal.png" />
                        </div>
                        <div class="project-body">
                            <b>Monopoly Deal</b>A remake of a politically based version of Monopoly Deal. This version of the game was originally created and programmed in Python by myself and <a href="http://wasiqm.com" target="_NEW">Wasiq Mohammad</a> in high school as a culminating assignment.

                            <div class="badge-section">
                                <span class="badge badge-pill custom-badge badge-green">Java</span>
                            </div>
                        </div>
                        <div class="row project-btn-cont">
                                <div class="col-sm project-btn btn-blue" data-href="https://github.com/RyanCoulsonCA/MonopolyDealRemake">Preview</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="project-data" style="color: red;">ASSIGNMENT</div>
                        <div class="project-image">
                            <img src="images/clientserver.png" />
                        </div>
                        <div class="project-body">
                            <b>Task Management Protocol</b>This was my final assignment in my systems programming class. It is a client server task management protocol, allowing the client to run commands remotely on the server. Utilises signals, networking, forks, piping, and more.

                            <div class="badge-section">
                                <span class="badge badge-pill custom-badge badge-red">C</span>
                            </div>
                        </div>
                        <div class="row project-btn-cont">
                                <div class="col-sm project-btn btn-purple" data-href="#contact">Contact Me</div>
                        </div>
                    </div>
                
                </div>  

                <!-- TODO: implement
                <center><a href="project.php">... or see them all</a></center>
                -->

            </div>
        </section>

        <?php if(isset($_GET['success'])) {?>
        <section class="custom-success" id="success">
            <div class="container"><i class="fa fa-check"></i>&nbsp;<b>Thank you!</b> I appreciate your message. I will try to get back to you as soon as I can.</div>
        </section>
        <?php }?>
        <?php if(isset($_GET['error'])) {?>
        <section class="custom-error" id="error">
            <div class="container"><i class="fa fa-times-circle"></i>&nbsp;<b>An Error Occurred</b> Did you remember to check the reCaptcha box?</div>
        </section>
        <?php }?>
        <section class="custom-contact" id="contact">
            <h1 class="custom-header" style="color: white; padding-bottom: 0px;">Let's get in touch</h1>
            <h2 class="custom-subtitle" style="color: white;">Fill in the requirements below and I'll reply as soon as possible!</h2>
            <div class="container" style="margin-top: 50px;">
                <?php
                $form_name = mysql_real_escape_string(strip_tags(stripslashes($_POST['name'])));
                $form_email = mysql_real_escape_string(strip_tags(stripslashes($_POST['email'])));
                $form_phone = mysql_real_escape_string(strip_tags(stripslashes($_POST['phone'])));
                $form_message = mysql_real_escape_string(strip_tags(stripslashes($_POST['message'])));
                $form_response = mysql_real_escape_string($_POST['g-recaptcha-response']);

      
                if(isset($_POST['submit'])) {
                    // Create map with request parameters
                    $params = array ('secret' => '6LdqFUQUAAAAAPiyqRqYYPRughQRfhMDGIApsfHe', 
                        'response' => $form_response);
                     
                    // Build Http query using params
                    $query = http_build_query ($params);
                     
                    // Create Http context details
                    $contextData = array ( 
                                    'method' => 'POST',
                                    'header' => "Connection: close\r\n".
                                                "Content-Length: ".strlen($query)."\r\n",
                                    'content'=> $query );
                     
                    // Create context resource for our request
                    $context = stream_context_create (array ( 'http' => $contextData ));
                     
                    // Read page rendered as result of your POST request
                    $result =  json_decode(file_get_contents (
                                      'https://www.google.com/recaptcha/api/siteverify',  // page url
                                      false,
                                      $context), true);
                     
                    // Server response is now stored in $result variable so you can process it
                    if($result['success'] == 1) {
                        mysql_query("INSERT INTO `admin.contact` (name, email, phone, ip, message, send_date)
                            VALUES('$form_name', '$form_email', '$form_phone', '".$_SERVER['REMOTE_ADDR']."', '$form_message', '".time()."')");
                        header("Location: ?success=true#success");
                    } else {
                        header("Location: ?error=true#error");
                    }
                }
                ?>
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" class="custom-input" name='name' placeholder="Name *" required />
                            <input type="text" class="custom-input" name='email' placeholder="Email *" required />
                            <input type="text" class="custom-input" name='phone' placeholder="Phone" />
                        </div>
                        <div class="col-md-6">
                            <textarea type="text" id='contact-text' class="custom-input" name='message' style="height: 192px; text-transform: none;" placeholder="Your Message *" /></textarea>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12" style="text-align: center;">
                            <div class="g-recaptcha" data-sitekey="6LdqFUQUAAAAAP0UHD07Ln21t7bT3tpN_fBIF_u7"></div>
                            <input type="submit" name="submit" class="btn btn-light custom-btn" style="cursor: pointer;" value="Send Message" />
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <section class="custom-footer">
            <div class="container">
            Copyright &copy; <?=date("Y")?> Ryan Coulson
                <div style="float: right; margin-top: -15px;">
                    <a href="http://twitter.com/RyanCoulsonCA" target="_NEW" class="custom-bubble"><i class="fa fa-twitter"></i></a>
                    <a href="https://github.com/RyanCoulsonCA" target="_NEW" class="custom-bubble"><i class="fa fa-github"></i></a>
                </div>
            </div>
        </section>


        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    </body>
</html>

          <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
          <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
          <script type="text/javascript" src="slick.min.js"></script>

          <script type="text/javascript">
            $(document).ready(function(){
                $('.carousel').slick({
                  infinite: true,
                  slidesToShow: 3,
                  slidesToScroll: 1,
                  autoplay: true,
                  accessibility: true,
                  adaptiveHeight: true,
                  pauseOnHover: true,
                  arrows: false,
                  dots: true
                });
            });
          </script>