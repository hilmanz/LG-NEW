<?php
//start session
session_start();

//just simple session reset on logout click
if($_GET["reset"]==1)
{
	session_destroy();
	header('Location: ./sosmed.php');
}

// Include config file and twitter PHP Library by Abraham Williams (abraham@abrah.am)
include_once("config.php");
include_once(base_url()."assets/inc/twitteroauth.php");
?>
<html>
<head>
<title>Sign-in with Twitter</title>
<style type="text/css">

</style>
</head>
<body>
<div class="wrapper">
<?php

if(isset($_SESSION['status']) && $_SESSION['status']=='verified') 
{	//Success, redirected back from process.php with varified status.
	//retrive variables
	$screenname 		= $_SESSION['request_vars']['screen_name'];
	$twitterid 			= $_SESSION['request_vars']['user_id'];

	$oauth_token 		= $_SESSION['request_vars']['oauth_token'];
	$oauth_token_secret = $_SESSION['request_vars']['oauth_token_secret'];

	//Show welcome message
	echo '<div class="welcome_txt">Username : <strong>'.$screenname.'</strong> <br> Twitter ID : '.$twitterid.'<br><a href="index.php?reset=1">Logout</a>!</div>';

	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);
	
	//see if user wants to tweet using form.
	if(isset($_POST["updateme"])) 
	{
		//Post text to twitter
		$my_update = $connection->post('statuses/update', array('status' => $_POST["updateme"]));
		die('<script type="text/javascript">window.top.location="index.php"</script>'); //redirect back to index.php
	}
	
	
		
}else{
	//login button
	echo '<a href="processtwitter.php"><img src="images/sign-in-with-twitter-l.png" width="151" height="24" border="0" /></a>';

}

?>
</div>
<?php

require_once('src/Facebook/FacebookSession.php');
require_once('src/Facebook/FacebookRequest.php');
require_once('src/Facebook/FacebookResponse.php');
require_once('src/Facebook/FacebookSDKException.php');
require_once('src/Facebook/FacebookRequestException.php');
require_once('src/Facebook/FacebookRedirectLoginHelper.php');
require_once('src/Facebook/FacebookAuthorizationException.php');
require_once('src/Facebook/GraphObject.php');
require_once('src/Facebook/GraphSessionInfo.php');
require_once('src/Facebook/GraphUser.php');
require_once('src/Facebook/Entities/AccessToken.php');
require_once('src/Facebook/HttpClients/FacebookCurl.php');
require_once('src/Facebook/HttpClients/FacebookHttpable.php');
require_once('src/Facebook/HttpClients/FacebookCurlHttpClient.php');

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\SDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphUser;
use Facebook\GraphSessionInfo;
use Facebook\FacebookHttpable;
use Facebook\FacebookCurlHttpClient;
use Facebook\FacebookCurl;

/*Codes*/
try{
session_start();

if(isset($_REQUEST['logout'])){
unset($_SESSION['fb_token']);
}

$app_id = '533895273426413';
$app_secret = 'd5801507ff7b26b5044960cf8c8a6e85';
$redirect_url = 'http://lgindonesia.com/lgforyou/login/';

FacebookSession::setDefaultApplication($app_id,$app_secret);
$helper = new  FacebookRedirectLoginHelper($redirect_url);
$sess = $helper->getSessionFromRedirect();



$logout = 'http://lgindonesia.com/lgforyou/login/?logout=true';

if(isset($sess)){
	// store token in session_cache_expire
	$accessToken = $sess->getAccessToken();
	$_SESSION['fb_token']=$accessToken->extend();
	
	//create request object, capture response
	$request = new FacebookRequest($sess,'GET','/me');
	
	//get graph object from response
	$response = $request->execute();
	$graph = $response->getGraphObject(GraphUser::classname());
	
	//get detail from graph object
	$name = $graph->getName(); 	//Full Name
	$id = $graph->getId();		// Facebook ID
	//$email = $graph->getPriority('email');		// Email
	
	//getting user image using http://graph.facebook.com/userid/picture
	$image = 'http://graph.facebook.com/'.$id.'/picture?width=300';
	
	//Display details
echo "<img src='$image'/> <br>";
	echo "Hello $name <br>";
	echo "Email $email <br>";
	echo "Your Facebook ID : $id <br>";
echo "<a href='".$logout."'><button>Logout</button></a>";
	
}
else{
//to get the login access
echo "<a href='".$helper->getLoginUrl(array('email','user_about_me'))."'><img src='images/sign-in-with-fb.png' width='151' height='24' border='0' /></a>";
}
}
catch(FacebookRequestException $e){
	echo "Error Occures, Code: ". $e->getCode();
}
?>
</body>
</html>
