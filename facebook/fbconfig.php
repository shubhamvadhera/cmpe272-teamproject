<?php
session_start();
// added in v4.0.0
require_once 'autoload.php';
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;
// init app with app id and secret
FacebookSession::setDefaultApplication( '439578306240054','5f1d57fa9f3362becbd47db2b2e1a377' );
// login helper with redirect_uri
    $helper = new FacebookRedirectLoginHelper('http://vishwasmukund.com/marketplace/facebook/fbconfig.php' );
try {
  $session = $helper->getSessionFromRedirect();
} catch( FacebookRequestException $ex ) {
  // When Facebook returns an error
} catch( Exception $ex ) {
  // When validation fails or other local issues
}
// see if we have a session
if ( isset( $session ) ) {
  // graph api request for user data
  $request = new FacebookRequest( $session, 'GET', '/me' );
  $response = $request->execute();
  // get response
  $graphObject = $response->getGraphObject();
     	$fbid = $graphObject->getProperty('id');              // To Get Facebook ID
 	$fbfullname = $graphObject->getProperty('name'); // To Get Facebook full name
	$femail = $graphObject->getProperty('email');    // To Get Facebook email ID
	$fbfname = $graphObject->getproperty('first_name');    // To Get Facebook first name
	$fblname = $graphObject->getProperty('last_name');    // To Get Facebook last name
	/* ---- Session Variables -----*/
	    $_SESSION['FBID'] = $fbid;
            $_SESSION['login']= 'TRUE';
            $_SESSION['username'] = $fbfullname;       
            $_SESSION['FULLNAME'] = $fbfullname;
	    $_SESSION['EMAIL'] =  $femail;
	    $_SESSION['FNAME'] =  $fbfname;
	    $_SESSION['LNAME'] =  $fblname;
	    
	/* ---- Save the username in the database ---- */
	    // Connect to mysql
	    if (!($database = mysql_connect("localhost:3306", "vishwasm_admin", "admin123"))) {
	       print("Failed to connect to the database. <br />" . mysql_error());
	    }
	    // Open the database
	    if (!mysql_select_db("vishwasm_marketplace", $database)) {
	       print("Failed to open the database. <br />" . mysql_error());
	    }
	    // create an insert statement
	    $insert = "INSERT INTO user (username, fname, lname) VALUES ('$fbfullname', '$fbfname', '$fblname')";
	    // execute the inert
	    if (!mysql_query($insert)) {
		/* user name is already in the table */
		/* not printing any error as it will mess up "header()". */
	    }
	    else {
		/* user name added in the table */
		/* not printing any message as it will mess up "header()". */
	    }
	    
    /* ---- header location after session ----*/
  header("Location: /marketplace/index.php");
} else {
  $loginUrl = $helper->getLoginUrl();
 header("Location: ".$loginUrl);
}
?>