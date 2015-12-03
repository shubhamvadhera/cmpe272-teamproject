<?php
	// start a session
	session_start();
	// check if user is logged in. if not, send to login.
	if (!(isset($_SESSION["login"]) && $_SESSION["login"] != "")) {
		header("Location: ../login-sign-in/sign-in.html");
		exit;
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">


<title>emporium-User History</title>

<style type="text/css">

/*
This was made by João Sardinha
Visit me at http://johnsardine.com/

The table style doesnt contain images, it contains gradients for browsers who support them as well as round corners and drop shadows.

It has been tested in all major browsers.

This table style is based on Simple Little Table By Orman Clark,
you can download a PSD version of this at his website, PremiumPixels.
http://www.premiumpixels.com/simple-little-table-psd/

PLEASE CONTINUE READING AS THIS CONTAINS IMPORTANT NOTES

*/

/*
Im reseting this style for optimal view using Eric Meyer's CSS Reset - http://meyerweb.com/eric/tools/css/reset/
------------------------------------------------------------------ */
body, html  { height: 100%; }
html, body, div, span, applet, object, iframe,
/*h1, h2, h3, h4, h5, h6,*/ p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, font, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td {
	margin: 0;
	padding: 0;
	border: 0;
	outline: 0;
	font-size: 100%;
	vertical-align: baseline;
	background: transparent;
}
body { line-height: 1; }
ol, ul { list-style: none; }
blockquote, q { quotes: none; }
blockquote:before, blockquote:after, q:before, q:after { content: ''; content: none; }
:focus { outline: 0; }
del { text-decoration: line-through; }
table {border-spacing: 0; } /* IMPORTANT, I REMOVED border-collapse: collapse; FROM THIS LINE IN ORDER TO MAKE THE OUTER BORDER RADIUS WORK */

/*------------------------------------------------------------------ */

/*This is not important*/
body{
	font-family:Arial, Helvetica, sans-serif;
	background: url(../img/bg/header-bg.jpg);
	margin:0 auto;
	width:520px;
}
a:link {
	color: #666;
	font-weight: bold;
	text-decoration:none;
}
a:visited {
	color: #666;
	font-weight:bold;
	text-decoration:none;
}
a:active,
a:hover {
	color: #bd5a35;
	text-decoration:underline;
}


/*
Table Style - This is what you want
------------------------------------------------------------------ */
table a:link {
	color: #666;
	font-weight: bold;
	text-decoration:none;
}
table a:visited {
	color: rgba(191,191,191,0.6);
	font-weight:bold;
	text-decoration:none;
}
table a:active,
table a:hover {
	color: #bd5a35;
	text-decoration:underline;
}
table {
	font-family:Arial, Helvetica, sans-serif;
	color:#666;
	font-size:12px;
	text-shadow: 1px 1px 0px #fff;
	background:#eaebec;
	margin:20px;
	border:#ccc 1px solid;

	-moz-border-radius:3px;
	-webkit-border-radius:3px;
	border-radius:3px;

	-moz-box-shadow: 0 1px 2px #d1d1d1;
	-webkit-box-shadow: 0 1px 2px #d1d1d1;
	box-shadow: 0 1px 2px #d1d1d1;
}
table th {
	padding:21px 25px 22px 25px;
	border-top:1px solid #fafafa;
	border-bottom:1px solid #e0e0e0;
	bacg

	background: transparent;
	background: -webkit-gradient(linear, left top, left bottom, from(#ededed), to(#ebebeb));
	background: -moz-linear-gradient(top,  #ededed,  #ebebeb);
}
table th:first-child{
	text-align: left;
	padding-left:20px;
}
table tr:first-child th:first-child{
	-moz-border-radius-topleft:3px;
	-webkit-border-top-left-radius:3px;
	border-top-left-radius:3px;
	background: rgba(255,255,255,0.1);
}
table tr:first-child th:last-child{
	-moz-border-radius-topright:3px;
	-webkit-border-top-right-radius:3px;
	border-top-right-radius:3px;
}
table tr{
	text-align: center;
	padding-left:20px;
}
table tr td:first-child{
	text-align: left;
	padding-left:20px;
	border-left: 0;
}
table tr td {
	padding:18px;
	border-top: 1px solid #ffffff;
	border-bottom:1px solid #e0e0e0;
	border-left: 1px solid #e0e0e0;
	
	background: #fafafa;
	background: -webkit-gradient(linear, left top, left bottom, from(#fbfbfb), to(#fafafa));
	background: -moz-linear-gradient(top,  #fbfbfb,  #fafafa);
}
table tr.even td{
	background: #f6f6f6;
	background: -webkit-gradient(linear, left top, left bottom, from(#f8f8f8), to(#f6f6f6));
	background: -moz-linear-gradient(top,  #f8f8f8,  #f6f6f6);
}
table tr:last-child td{
	border-bottom:0;
}
table tr:last-child td:first-child{
	-moz-border-radius-bottomleft:3px;
	-webkit-border-bottom-left-radius:3px;
	border-bottom-left-radius:3px;
}
table tr:last-child td:last-child{
	-moz-border-radius-bottomright:3px;
	-webkit-border-bottom-right-radius:3px;
	border-bottom-right-radius:3px;
}
table tr:hover td{
	background: #f2f2f2;
	background: -webkit-gradient(linear, left top, left bottom, from(#f2f2f2), to(#f0f0f0));
	background: -moz-linear-gradient(top,  #f2f2f2,  #f0f0f0);	
}
			}
			 		  		 
			
</style>

</head>

<body>

    <div style="">
    	<h3>Users Activity Log</h3>
    </div>

<?php
    
    // Connect to mysql
    if (!($database = mysql_connect("localhost:3306", "vishwasm_admin", "admin123"))) {
       print("Failed to connect to the database. <br />" . mysql_error());
    }
    // Open the database
    if (!mysql_select_db("vishwasm_marketplace", $database)) {
       print("Failed to open the database. <br />" . mysql_error());
    }
    
    // print the title
    print("<h1 style='color:white'>User Activity Stats</h1>");
    // create the query
    $username = $_SESSION['username'];
    $query1 = "SELECT v.vendor_name, p.product_name, count(*) AS views FROM `userlog` ul 
    		JOIN products p ON ul.product_id = p.product_id
    		JOIN vendor v ON p.vendor_id = v.vendor_id 
    		WHERE ul.user_id = '$username' 
    		GROUP BY ul.product_id
    		ORDER BY views desc;";
    // run the query
    $result1 = mysql_query($query1);
    // Check how many results were returned
    $numResults1 = mysql_num_rows($result1);
    
    // display the resutls
    if ($numResults1 > 0) {
    	print("<table>");
        // Print the headers
        print("<tr>");
        	print("<th>VENDOR:</th>");
                print("<th>PRODUCT:</th>");
                print("<th>VIEWS:</th>");
        print("</tr>");
        // Print the results
        while ($row = mysql_fetch_row($result1)) {
        	print("<tr>");
        	foreach ($row as $key => $value) {
        		print("<td>$value</td>");
        	}
        	print("</tr>");
       }
       print("</table>");
   } else {
    print("<h4 style='color:white'>No activity records</h4>");   
   }
   
    // print the title
    print("<h1 style='color:white'>User Activity Log</h1>");   
    // create the query
    $query2 = "SELECT v.vendor_name, p.product_name, ul.timestamp FROM `userlog` ul 
    		JOIN products p ON ul.product_id = p.product_id
    		JOIN vendor v ON p.vendor_id = v.vendor_id 
    		WHERE ul.user_id = '$username'
    		ORDER BY ul.timestamp desc; ";

    // run the query
    $result2 = mysql_query($query2);
    // Check how many results were returned
    $numResults2 = mysql_num_rows($result2);
    
    // display the resutls
    if ($numResults2 > 0) {
    	print("<table>");
        // Print the headers
        print("<tr>");
        	print("<th>VENDOR:</th>");
                print("<th>PRODUCT:</th>");
                print("<th>DATE:</th>");
        print("</tr>");
        // Print the results
        while ($row = mysql_fetch_row($result2)) {
        	print("<tr>");
        	foreach ($row as $key => $value) {
        		print("<td>$value</td>");
        	}
        	print("</tr>");
       }
       print("</table>");
   } else {
    print("<h4 style='color:white'>No activity records</h4>");   
   }
?>

</body>




</html>