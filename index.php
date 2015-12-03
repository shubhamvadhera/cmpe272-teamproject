<?php
	// start a session
	session_start();
	
?>
<!DOCTYPE html>
<html lang="en-us">
    <head>
    	<title>e-mporium</title>

    	<!-- meta -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- stylesheet -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/owl.carousel.css">
		<link rel="stylesheet" href="css/owl.theme.min.css">
        <link rel="stylesheet" href="css/animate.css">
		<link rel="stylesheet" href="css/main.css">

		<!-- google font -->
        <link href='http://fonts.googleapis.com/css?family=Oswald:300,400' rel='stylesheet'>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Oxygen:400,300' rel='stylesheet' type='text/css'>
        <link href="http://fonts.googleapis.com/css?family=Rouge+Script" rel="stylesheet" type="text/css">
        <link href='http://fonts.googleapis.com/css?family=Milonga' rel='stylesheet' type='text/css'>
    </head>
    <body>
    <?php
    	$indexStatsQuery = "SELECT  (SELECT COUNT(*) FROM   products ) AS products,
        (SELECT COUNT(*) FROM   vendor ) AS vendor,
        (SELECT COUNT(*) FROM   user ) AS user,
        (SELECT COUNT(rating) FROM   rating ) as rating,
	(SELECT COUNT(review) FROM   rating ) as review,
	(SELECT COUNT(1) FROM   userlog) as total FROM  dual";
	 if ( !( $database = mysql_connect( "localhost","vishwasm_root", "root123" ) ) ) {                          
	    	echo( "Could not connect to database" );
		die( "Could not connect to database" );
	}
        if ( !mysql_select_db( "vishwasm_marketplace", $database ) ){      
		   echo( "Could not open Products database" );
		   die( "Could not open Products database" );
	}      
    if ( !( $result = mysql_query( $indexStatsQuery, $database ) ) ) {
       echo( "Could not execute query! <br />" );
       die( mysql_error() );
    }
    $userCount = mysql_result($result, 0, 2);
    $vendorCount = mysql_result($result, 0, 1);
    $reviewCount = mysql_result($result, 0, 4);
    $ratingCount = mysql_result($result, 0, 3);
    $productCount = mysql_result($result, 0, 0);
    $totalCount = mysql_result($result, 0, 5);
    mysql_close($database);
    //echo $userCount.' '.$vendorCount.' '.$reviewCount.' '.$ratingCount.' '.$productCount;
    ?>
        <div class="content-block" id="header">
            <div id="overlay-1">
                <header id="site-header" class="clearfix">
                    <div class="pull-left">
                        <h1><a href="#">e-mporium</a></h1>
                    </div>
                    <div class="pull-right">
                        <nav class="navbar site-nav" role="navigation">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                    <i class="fa fa-bars fa-2x"></i>
                                </button>
                            </div>

                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                    <li class="active"><a href="#header"><i class="fa fa-home"></i> <span>Home</span></a></li>
                                    <li><a href="#portfolio"><i class="fa fa-bookmark"></i> Portfolio</a></li>
                                    <li><a href="#services"><i class="fa fa-bullhorn"></i> About Me</a></li>
                                    <li><a href="#testimonials"><i class="fa fa-thumbs-up"></i> Our Vendors</a></li>
                                    <li><a href="#contact"><i class="fa fa-phone-square"></i> Contact</a></li>
                                    <?php if(!(isset($_SESSION["login"]) && $_SESSION["login"] != "")) {
                                    	echo '<li><a href="login-sign-in/sign-in.html"><i class="fa fa-user"></i>Sign in</a></li>                                
';
                                    } else {
                                    	echo '<li><a href="products/history.php"><i class="fa fa-history"></i>Surf History</a></li>';
                                    	echo '<li><a href="login-sign-in/logout.php"><i class="fa fa-sign-out"></i>Logout</a></li>';
                                    }?>
                                    
                                </ul>
                            </div>  <!-- /.navbar-collapse -->
                        </nav>
                    </div>
                </header>	<!-- site-header -->
                
                <div class="middle text-center clearfix">
                    <div class="container">
                        <h1 class="pro-name">Welcome to e-mporium!!</h1>
                        <p class="tagline">A marketplace just like you need it<br>Everything under one roof</p>                        
                        <div class="skills">

                        </div>  <!-- skills -->
                        <a href="#portfolio" target="_blank" class="btn btn-lg btn-hire wow animated zoomIn">Get started</a>
                    </div>  <!-- container -->
                </div>  <!-- middle -->
                
                <div class="bottom text-center">
                    <a href="#portfolio"><i class="fa fa-angle-down fa-3x pulse"></i></a>
                </div>
            </div>  <!-- overlay-1 -->
        </div>  <!-- content-block -->

        <div class="content-block text-center" id="portfolio">
            <header class="block-heading cleafix">
                <h1>Our Portfolio</h1>
                <!-- <p>Take a look at some of my recent products</p> -->
            </header>



<!--product page  -->
            <div class="isotope portfolio-items">
                <div class="element-item grid">
                    <div class="effect-zoe">
                        <img class="img-responsive" alt="Portfolio" src="img/work1.jpg">
                        <figcaption>
                            <h2 class="hidden-xs">Midas Dream cars</h2>
                          
                                <a href="products/midas.php"></a>
                                                           
                        </figcaption>
                    </div>
                </div>
                <div class="element-item grid">
                    <div class="portfolio-item effect-zoe">
                        <img class="img-responsive" alt="Portfolio" src="img/work2.jpg">
                        <figcaption>
                            <h2 class="hidden-xs">TTMdiscover co</h2>
                             <a href="products/ttm.php"></a>
                        </figcaption>
                    </div>
                </div>
                <div class="element-item grid">
                    <div class="portfolio-item effect-zoe">
                        <img class="img-responsive" alt="Portfolio" src="img/work3.jpg">
                        <figcaption>
                            <h2 class="hidden-xs">Littles gift shop</h2>
                             <a href="products/giftshop.php"></a>
                        </figcaption>
                    </div>
                </div>
                
                
                
                <div class="element-item grid">
                    <div class="portfolio-item effect-zoe">
                        <img class="img-responsive" alt="Portfolio" src="img/bg/stats_bg.png" style="width:319px; height:213px">
                        <figcaption>
                            <h2 class="hidden-xs">Product Visit Statistics</h2>
                             <a href="products/visitStats.php"></a>
                        </figcaption>
                    </div>
                </div>
                
               
                <div class="element-item grid">
                    <div class="portfolio-item effect-zoe">
                        <img class="img-responsive" alt="Portfolio" src="img/work4.jpg">
                        <figcaption>
                            <h2 class="hidden-xs">Dextrous Game On !</span></h2>
                           <a href="products/game.php"></a>
                        </figcaption>
                    </div>
                </div>
                <div class="element-item grid">
                    <div class="portfolio-item effect-zoe">
                        <img class="img-responsive" alt="Portfolio" src="img/work5.jpg">
                        <figcaption>
                            <h2 class="hidden-xs">Dhaba On Wheels</h2>
                            <a href="products/dhaba.php"></a>
                        </figcaption>
                    </div>
                </div>
                <div class="element-item grid">
                    <div class="portfolio-item effect-zoe">
                        <img class="img-responsive" alt="Portfolio" src="img/work6.jpg">
                        <figcaption>
                            <h2 class="hidden-xs">Maru Maru Pottery</h2>
                            <a href="products/pottery.php"></a>
                        </figcaption>
                    </div>
                </div>
                
                
                <div class="element-item grid">
                    <div class="portfolio-item effect-zoe">
                        <img class="img-responsive" alt="Portfolio" src="img/bg/stats_bg_2.png" style="width:319px; height:213px">
                        <figcaption>
                            <h2 class="hidden-xs">Rating Statistics</h2>
                            <a href="products/ratingStats.php"></a>
                        </figcaption>
                    </div>
                </div>
                
            </div>	<!-- isotope portfolio-items -->
            
        </div>  <!-- content-block -->

       <!--  <div class="content-block text-center" id="services">
            <div class="overlay-2">
                        <header class="block-heading cleafix">
                            <h1>More About Me</h1>
                            <p>Lorem Ipsum Text</p>
                        </header>
                        <div class="block-content">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                <div class="row ">
                                    <div class="col-sm-4">
                                        <h4 class="pro-stat">Completed Project</h4>
                                        <h2 class="proj-name count1 count-timer" >020</h2>
                                    </div>
                                    <div class="col-sm-4">
                                        <h4 class="pro-stat">Working Project</h4>
                                        <h2 class="proj-name count2">9</h2>
                                    </div>
                                    <div class="col-sm-4">
                                        <h4 class="pro-stat">Top Rated Project</h4>
                                        <h2 class="proj-name count3">015</h2>
                                    </div>
                                </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>    overlay-2
        </div>  --> <!-- content-block -->
        
        <div id="services" class="content-block">
            <div id="numbers" class="parallax">
                <div class="overlay">
                    <!-- title -->
                    <div class="container-fluid numbers-title">
                        <div class="container">
                            <div class="row block-heading">
                            	<h4>e-mporium is a fresh on board marketplace built by some nerds from San Jose State University. A common place for people wanting to shop from a wide range of products. You can view the most trending products along with best rated and most reviewed products in our portal. Feel free to share your review and do not missing rating any product you like. Connect with us through the Contact Form.</h4> 
                            	<br>
                                <h1>Some Cool Facts About Us</h1>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <!-- number list -->
                        <ul class="numbersList">
                            <li class="col-md-2 col-sm-4 col-xs-6">
                                <h4> Active Users </h4>
                                <span id="number1" class="count1 count-timer"><? echo $userCount ?></span>
                            </li>
                            <li class="col-md-2 col-sm-4 col-xs-6">
                                <h4> Product Protfolio</h4>
                                <span id="number2" class="count2"><?php echo $productCount?></span>
                            </li>
                            <li class="col-md-2 col-sm-4 col-xs-6">
                                <h4> Our Vendors</h4>
                                <span id="number3"  class="count3"><?php echo $vendorCount ?></span>
                            </li>
                            <li class="col-md-2 col-sm-4 col-xs-6">
                                <h4>User Reviews</h4>
                                <span id="number4" class="count4"><?php echo $reviewCount?></span>
                            </li>
                            <li class="col-md-2 col-sm-4 col-xs-6">
                                <h4>User Ratings</h4>
                                <span id="number5" class="count5"><?php echo $ratingCount ?></span>
                            </li>
                            <li class="col-md-2 col-sm-4 col-xs-6">
                                <h4>Total Visitors</h4>
                                <span id="number6" class="count6"><?php echo $totalCount ?></span>
                            </li>
                        </ul><!-- numbersList end -->
                    </div><!-- container-fluid end -->
                </div><!-- overlay end -->
            </div>
        </div>
            

        <div class="content-block" id="testimonials">
            <header class="block-heading cleafix text-center">
                <h1>Our Vendors</h1>
                <!-- <p>Lorem Ipsum Text</p> -->
            </header>
            <div class="block-content text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                        	<div class="owl-carousel">
								<div class="owl-item">
									<div class="testimonial" style="color:#FFF8DC">
                                        <img alt="Client Photo" src="img/giftShop.jpg">
                                        <p>Offering wide variety of customized products. If you need to gift your near and dear ones, you are at the right place</p>
                                        <strong>Sneha Jain</strong><br>
                                        <span>CEO of Little's Gift Shop</span>
                                    </div>
								</div>	<!-- owl-item -->
								<div class="owl-item">
									<div class="testimonial" style="color:#FFF8DC">
                                        <img alt="Client Photo" src="img/wheels.jpg">
                                        <p>serves MOM's Original delight food to the door step.You just need to order and give us an oppotunity to serve you the best food indian food in downtown San Jose.</p>
                                        <strong>Parveen Kumar </strong><br>
                                        <span>CEO of Dhabaonwheels</span>
                                    </div>
								</div>	<!-- owl-item -->
								<div class="owl-item">
									<div class="testimonial" style="color:#FFF8DC">
                                        <img alt="Client Photo" src="img/ttmDiscover.jpg">
                                        <p>we can provide you with well trained real people who can share a talk with you and help you communicate with them , chat with you at your house , or in the park are you feeling lonely and no one can understand you as you wish .</p>
                                        <strong>Waad Aljaradt</strong><br>
                                        <span>CEO of TTMDiscover</span>
                                    </div>
								</div>	<!-- owl-item -->
				
								<div class="owl-item">
									<div class="testimonial" style="color:#FFF8DC">
                                        <img alt="Client Photo" src="img/games.jpg">
                                        <p>DextrouS was established in 2014 with 3 developers that had a vision to change the gaming industry forever.</p>
                                        <strong>Shubham Vadhera</strong><br>
                                        <span>CEO of DextrouS</span>
                                    </div>
								</div>	<!-- owl-item -->
								
								<div class="owl-item">
									<div class="testimonial" style="color:#FFF8DC">
                                        <img alt="Client Photo" src="img/madias.jpg">
                                        <p>We lease Luxury and high performance cars. We are an exclusive club and we have a network of members all over the world.</p>
                                        <strong>Vishwas Mukund </strong><br>
                                        <span>CEO of Midas </span>
                                    </div>
								</div>	<!-- owl-item -->
								<div class="owl-item">
									<div class="testimonial" style="color:#FFF8DC">
                                        <img alt="Client Photo" src="img/pottery.jpg">
                                        <p>Our goal is to bring a piece of art in your everyday life. Each pottery we make is handcrafted by our artists. We specialize in traditional style Japan potteries with some modern twists..</p>
                                        <strong>Joji Kubota </strong><br>
                                        <span>CEO of Maru Maru Pottery </span>
                                    </div>
								</div>	<!-- owl-item -->
							</div>	<!-- owl-carousel -->
						</div>	<!-- col-md-12 -->
                    </div>	<!-- row -->
                </div>	<!-- container -->
            </div>	<!-- block-content -->
        </div>	<!-- content-block -->

        <div class="content-block" id="contact">
            <div class="overlay-3">
                <header class="block-heading cleafix text-center">
                    <h1>Contact</h1>

                </header>
                <div class="block-content text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 wow animated fadeInLeft">
                                <form class="contact-form" method='post'>
                                    <input type="text" name="name" placeholder="Name" required>
                                    <input type="email" name="email" placeholder="Email" required>
                                    <textarea rows="5" name="message" placeholder="Say Something..." required></textarea>
                                    <input type="submit" value="Submit">
                                </form>
                            </div>
                            <div class="col-md-6 wow animated fadeInRight">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="contact-info">
                                            <div class="clearfix">
                                                <div class="rotated-icon">
                                                    <div class="sqaure-nebir"></div>
                                                    <i class="fa fa-map-marker"></i>
                                                </div>
                                                <p><strong> Address:</strong>  1 Washington Sq, San Jose, CA 95192.
                                                </p>
                                            </div>
                                            <div class="clearfix">
                                                <div class="rotated-icon">
                                                    <div class="sqaure-nebir"></div>
                                                    <i class="fa fa-mobile"></i>
                                                </div>
                                                <p><strong> Cell No:</strong> 1-800-123-456 </p>
                                            </div>
                                            <div class="clearfix">
                                                <div class="rotated-icon">
                                                    <div class="sqaure-nebir"></div>
                                                    <i class="fa fa-envelope-o"></i>
                                                </div>
                                                <p>
                                                    <strong> Email:</strong> developer@gmail.com
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <ul class="social-box">
                                        <li><a class="facebook-icon" href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a class="twitter-icon" href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a class="g-plus-icon" href="#"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a class="linkedin-icon" href="#"><i class="fa fa-linkedin"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>	<!-- block-content -->
            </div>	<!-- overlay-3 -->
        </div>	<!-- content-block -->

        <footer id="site-footer">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="copyright">November 2015</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="designed-by">Designed By Team e-mporium</div>
                    </div>
                </div>
            </div>
        </footer>	<!-- site-footer -->

	<?php
	if($_SERVER['REQUEST_METHOD']== "POST")
	{
		echo '<script type="text/javascript">'; 
		echo 'alert("THANK YOU FOR THE FEEDBACK");'; 
		echo 'window.location.href = ".";';
		echo '</script>';
		
		$senderEmail = $_POST['email'];
		$senderName = $_POST['name'];
		$senderMessage = $_POST['message'];				
		$body = 'Thank you '.$senderName.' for connecting to us. We shall respond your message as soon as possible';
		$subject = 'Thank you for connecting to e-mporium';
		$header = 'Response from e-mporium';
		
		//echo "Email address is:" +$to;
		mail($senderEmail, $subject, $body, $header);
		mail('snehajain2210@gmail.com', 'e-mporium User email', $senderMessage, $senderName.' sender email id: '.$senderEmail);
		mail('shubhamvadhera@gmail.com', 'e-mporium User email', $senderMessage, $senderName.' sender email id: '.$senderEmail);


	}
	?>

        <!-- js -->
        <script>
            new WOW().init();
        </script>

        <script src="js/jquery-2.1.3.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.actual.min.js"></script>
        <script src="js/isotope.pkgd.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/jquery.isonscreen.js"></script>
       
        <script src="js/main.js"></script>

        <script>
        	$(document).ready(function(){
  				$('.owl-carousel').owlCarousel({
    				loop:true,
    				margin:10,
    				autoplay:true,
    				autoplayTimeout:3000,
    				autoplayHoverPause:true,
    				responsiveClass:true,
    				responsive:{
        					0:{
					            items:1,
        					},
					        600:{
					            items:1,
					        },
					        1000:{
					            items:1,
					        }
    				}
				})
			});
        </script>

	</body>
</html>