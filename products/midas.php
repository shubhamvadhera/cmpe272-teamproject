<?php
	// start a session
	session_start();
	ini_set('date.timezone', 'America/Los_Angeles'); 	
	// check if user is logged in. if not, send to login.
	if (!(isset($_SESSION["login"]) && $_SESSION["login"] != "")) {
		header("Location: ../login-sign-in/sign-in.html");
		exit;
	}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	  <link rel="stylesheet" src="star.css">
	  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
	  <link href="http://www.cssscript.com/wp-includes/css/sticky.css" rel="stylesheet" type="text/css">
	  	  	  
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	  
	<title>e-mporium: Midas Car Lease</title>
	
	<style>
	a {
	color:#3b5998;
	}
	/*Dynamic Stars-Start*/	
	div.stars {
	  width: 150px;
	  display: inline-block;
	}
	input.star { display: none; }
	
	label.star {
	  float: right;
	  padding: 5px;
	  font-size: 20px;
	  color: #444;
	  transition: all .2s;
	}
	
	input.star:checked ~ label.star:before {
	  content: '\f005';
	  color: #FD4;
	  transition: all .25s;
	}
	
	input.star-5:checked ~ label.star:before {
	  color: #FE7;
	  text-shadow: 0 0 20px #952;
	}
	
	input.star-1:checked ~ label.star:before { color: #F62; }
	
	label.star:hover { transform: rotate(-15deg) scale(1.3); }
	
	label.star:before {
	  content: '\f006';
	  font-family: FontAwesome;
	}
	
	/*Dynamic Stars-End*/	
		
	/*Static Stars-Start*/
	
	
	span.stars, span.stars span {
	    display: block;
	    background: url(stars.png) 0 -16px repeat-x;
	    width: 80px;
	    height: 16px;
	}
	
	span.stars span {
	    background-position: 0 0;
	}
	.rating {
	      overflow: hidden;
	      display: inline-block;
	  }
	  .rating-input {
	      float: right;
	      width: 16px;
	      height: 16px;
	      padding: 0;
	      margin: 0 0 0 -16px;
	      opacity: 0;
		  background: url('stars.png') 0 -16px;
	  }
	.rating:hover .rating-star:hover,
	.rating:hover .rating-star:hover ~ .rating-star,
	.rating-input:checked ~ .rating-star {
	      background-position: 0 0;
	  }
	  .rating-star,
	  .rating:hover .rating-star {
	      position: relative;
	      float: right;
	      display: block;
	      width: 16px;
	      height: 16px;
	      background: url('stars.png') 0 -16px;
	  }
	/*Static Stars-End*/
		
		  .open .dropdown-toggle {
		      color: #fff;
		      background-color: #555 !important;
		  }
		  .dropdown-menu li a {
		      color: #000 !important;
		  }
		  .dropdown-menu li a:hover {
		      background-color: red !important;
		  }
		
		  textarea {
		      resize: none;
		  }
	
		#bg {
			position:fixed; 
			top:-50%; 
			left:-50%; 
			width:200%; 
			height:200%;
		}
		#bg img {
			position:absolute; 
			top:0; 
			left:0; 
			right:0; 
			bottom:0; 
			margin:auto; 
			min-width:50%;
			min-height:50%;
		}
		
		#page-wrap { position: relative; z-index: 2; width: 1000px; margin: 50px auto; padding: 20px; background: rgba(188, 200, 216, 0.7); -moz-box-shadow: 0 0 20px black; -webkit-box-shadow: 0 0 20px black; box-shadow: 0 0 20px black; }
		p { font: 15px/2 Georgia, Serif; margin: 0 0 30px 0; text-indent: 40px; }
		
		.close {position:absolute;top:20px;right:20px;background:url(../img/close.gif) 0 0 no-repeat;width:15px;height:15px}
		.close span {position:absolute;width:100%;height:100%;top:0;left:0;background:url(../img/close_active.gif) 0 0 no-repeat}
		
	</style>
	<link href="http://www.cssscript.com/wp-includes/css/sticky.css" rel="stylesheet" type="text/css">
</head>

<body>
	
	<div id="page-wrap">
	<h3>
	<a href="http://vishwasmukund.com/marketplace" class="close" data-type="close"><span></span></a>
	</h3>
		<div id="navigation">
  	<div class="wrapper">
   	  <ul>
      	<a href="http://vishwasmukund.com/marketplace/" style="color: #6666cc;">Home</a>
   	</ul>
  	</div>
	</div>
	
	<?php 
		if($_SERVER['REQUEST_METHOD']== "POST"){
			$loopid =  $_POST['loopid'];
			$productid= intval($_POST['productid']);
			$userreview = 'userReview'.$loopid;
			$ratings = 'star'.$loopid;
			if($_POST[$userreview]==''&&!isset($_POST[$ratings])) {
				//Nothing to do
			} else {
				if ( !( $database1 = mysql_connect( "localhost","vishwasm_root", "root123" ) ) ) {                                         
					    echo( "Could not connect to database" );
						die( "Could not connect to database" );
						}
		            if ( !mysql_select_db( "vishwasm_marketplace", $database1 ) ){
		              
					   echo( "Could not open Products database" );
					    die( "Could not open Products database" );
						}
		      			
				$username = $_SESSION['username'];
				$userReviewCaptured = $_POST[$userreview]==''?'NULL':$_POST[$userreview];
				$userRatingCaptured = isset($_POST[$ratings])?$_POST[$ratings]:'NULL';
				if($_POST[$userreview]=='') {
				$insertQuery = "insert into rating values ('".$username."', ".$productid.", ".$userRatingCaptured.", NULL, '".date('Y-m-d')."') on duplicate key update rating=".$userRatingCaptured.", review=NULL;";
				} else {
				$insertQuery = "insert into rating values ('".$username."', ".$productid.", ".$userRatingCaptured.", '".$userReviewCaptured."', '".date('Y-m-d')."') on duplicate key update rating=".$userRatingCaptured.", review='".$userReviewCaptured."';";
				}											
				
				//echo $insertQuery;
				mysql_query( $insertQuery, $database1 );
				mysql_close($database1);
			}
		}
	?>
	
<?php
	
	$query = "select p.product_name,p.product_desc,p.product_url, p.product_id, ifnull(avg(r.rating),0), count(r.rating), count(r.review) from  products p left join rating r on r.product_id = p.product_id where vendor_id='midas' group by p.product_id order by p.product_id";
	 if ( !( $database = mysql_connect( "localhost","vishwasm_root", "root123" ) ) ) {                          
               
			    echo( "Could not connect to database" );
				die( "Could not connect to database" );
				}
            if ( !mysql_select_db( "vishwasm_marketplace", $database ) ){
              
			   echo( "Could not open Products database" );
			    die( "Could not open Products database" );
				}
      
            // query Products database
            if ( !( $result = mysql_query( $query, $database ) ) ) {
               echo( "Could not execute query! <br />" );
               die( mysql_error() );
            }
            
             $reviewsQuery = "select r.review, r.product_id, r.review_date, r.user_id, IFNULL( r.rating, 0 ) as rating from rating r join products pr on pr.product_id = r.product_id where pr.vendor_id='midas' and r.review is not NULL and LENGTH(r.review)>0 order by r.product_id, r.review_date";		
	  
	  if ( !( $reviewResult = mysql_query( $reviewsQuery, $database ) ) ) {
               echo( "Could not execute retrieve review query! <br />" );
               die( mysql_error() );
            }
            $reviewData = array();
            while($row=mysql_fetch_assoc($reviewResult)) {
            array_push($reviewData, $row);
            }        	   
            $index=0;
			
			   
?> 

<table class="table">
	<?php for($i=0;$i<10;$i++){
		echo '<tr>';
		echo '<td style="width:250px">';
		echo '<figure><img src="../img/prod/page1_img'.($i+1).'.jpg"></figure>';
		echo '</td>';
		echo '<td>';
		echo '<font size="5px"><b>'.mysql_result($result, $i, 0).'</b></font>';
		echo '<br><font size="4px">'.mysql_result($result, $i, 1);
		echo '</font><br>';
		echo '<a href="'.mysql_result($result, $i, 2).'">Read More</a>';
		echo '<div class="pull-right"><span class="stars pull-left">'.mysql_result($result, $i, 4).'</span>('.mysql_result($result, $i, 5).')
		</div>';
		echo '<br>';	
		
		echo '<a class="btn btn-xs pull-right" role="button" data-toggle="collapse" href="#reviewSection'.$i.'" aria-expanded="false" aria-controls="collapseExample" style="padding: 1px 0px">Check Reviews ('.mysql_result($result, $i, 6).')</a>';
		echo '<a class="btn btn-xs pull-right" role="button" data-toggle="collapse" href="#newReview'.$i.'" aria-expanded="false" aria-controls="collapseExample" style="margin-right:20px">Write a Review</a>';


		echo '<div class="collapse " id="newReview'.$i.'">';
		echo '<div class="well" style="float:left; width:600px; overflow-y: auto; max-height: 200px; padding:5px">';	
		echo '<form method="POST">';
		echo '<div class="stars">
		      <input class="star star-5" id="star-5-'.$i.'" type="radio" name="star'.$i.'" value="5" />
		      <label class="star star-5" for="star-5-'.$i.'"></label>
		      <input class="star star-4" id="star-4-'.$i.'" type="radio" name="star'.$i.'" value="4"  />
		      <label class="star star-4" for="star-4-'.$i.'"></label>
		      <input class="star star-3" id="star-3-'.$i.'" type="radio" name="star'.$i.'" value="3"  />
		      <label class="star star-3" for="star-3-'.$i.'"></label>
		      <input class="star star-2" id="star-2-'.$i.'" type="radio" name="star'.$i.'" value="2" />
		      <label class="star star-2" for="star-2-'.$i.'"></label>
		      <input class="star star-1" id="star-1-'.$i.'" type="radio" name="star'.$i.'" checked value="1" />
		      <label class="star star-1" for="star-1-'.$i.'"></label>
		  </div>';
		echo '<textarea style="width:100%" placeholder="Share your reviews about this product" name="userReview'.$i.'"></textarea>';
		echo '<p hidden><input name="productid" value="'.mysql_result($result, $i, 3).'">
			<input name="loopid" value="'.$i.'"></p>';
		echo '<input class="btn btn-xs pull-right" type="submit" value="Submit">';
		echo '</form>';
		echo '</div></div>';
		
		echo '<div class="collapse " id="reviewSection'.$i.'">';
		echo '<div class="well" style="float:left; width:600px; overflow-y: auto; max-height: 200px; padding:5px">';	
		if($reviewData[$index]['product_id']==mysql_result($result, $i, 3)) {
		  	echo '<ul>';
		  	while($reviewData[$index]['product_id']==mysql_result($result, $i, 3)) {
			echo '<li>'.$reviewData[$index]['review'].'</li>';
			echo '<li> <div class="pull-left"><span class="stars">'.$reviewData[$index]['rating'].'</span></div>
			<div class="pull-right" style="font-style:italics; font-size:10px">by '.$reviewData[$index]['user_id'].' on '.date("M d, Y",strtotime($reviewData[$index]['review_date'])).'</div></li>';
			echo '<li style="height:1px;border:solid 1px #666"> </li>';
			$index++;
		  	}
		  	echo '</ul>';			  	
		 } else {
		echo 'No reviews yet, be the first one to review';
		}
		echo '</div></div>';
		
		echo '</td>';
		echo '</tr>';		
	}
	?>	
	
	
	
</table>

	
	</div>

	
	<!-- At bottom, 'cause it's not really content -->
	<div id="bg">
		<img src="../img/bg/bg_img10.jpg" alt="error">
	</div>
	
 <style type="text/css" style="display: none !important;">
	* {
		margin: 0;
		padding: 0;
	}
	body {
		overflow-x: hidden;
	}
	#demo-top-bar {
		text-align: left;
		background: #222;
		position: relative;
		zoom: 1;
		width: 100% !important;
		z-index: 6000;
		padding: 20px 0 20px;
	}
	#demo-bar-inside {
		width: 960px;
		margin: 0 auto;
		position: relative;
		overflow: hidden;
	}
	#demo-bar-buttons {
		padding-top: 10px;
		float: right;
	}
	#demo-bar-buttons a {
		font-size: 12px;
		margin-left: 20px;
		color: white;
		margin: 2px 0;
		text-decoration: none;
		font: 14px "Lucida Grande", Sans-Serif !important;
	}
	#demo-bar-buttons a:hover,
	#demo-bar-buttons a:focus {
		text-decoration: underline;
	}
	#demo-bar-badge {
		display: inline-block;
		width: 302px;
		padding: 0 !important;
		margin: 0 !important;
		background-color: transparent !important;
	}
	#demo-bar-badge a {
		display: block;
		width: 100%;
		height: 38px;
		border-radius: 0;
		bottom: auto;
		margin: 0;
		background: url(/images/examples-logo.png) no-repeat;
		background-size: 100%;
		overflow: hidden;
		text-indent: -9999px;
	}
	#demo-bar-badge:before, #demo-bar-badge:after {
		display: none !important;
	}
</style>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46156385-1', 'cssscript.com');
  ga('send', 'pageview');

	//To display stars
	$.fn.stars = function() {
	    return $(this).each(function() {
	        // Get the value
	        var val = parseFloat($(this).html());
	        // Make sure that the value is in 0 - 5 range, multiply to get width
	        var size = Math.max(0, (Math.min(5, val))) * 16;
	        // Create stars holder
	        var $span = $('<span />').width(size);
	        // Replace the numerical value with stars
	        $(this).html($span);
	    });
	}

	$(function() {
	    $('span.stars').stars();
	});


</script>
</body>

</html>