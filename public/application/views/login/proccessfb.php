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
$app_id = '1623657927892930';
$app_secret = '32b5861c4802caad92cd70005838ac1f';
//$redirect_url = 'http://mfebriansyah.com/fb/tw/proccessfb.php';
$redirect_url = 'http://lgindonesia.com/lgforyou/login';

FacebookSession::setDefaultApplication($app_id,$app_secret);
$helper = new  FacebookRedirectLoginHelper($redirect_url);
$sess = $helper->getSessionFromRedirect();

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
	
	//getting user image using http://graph.facebook.com/userid/picture
	$iamge = 'http://graph.facebook.com/'.$id.'/picture?width=300';
	
	//Display details
	echo "Hello $name <br>";
	echo "Email $email <br>";
	echo "Your Facebook ID : $id <br>";
	
}
else{
//to get the login access
echo "<a href='".$helper->getLoginUrl(array('email','user_about_me'))."'>Login with fb</a>";
}
}
catch(FacebookRequestException $e){
	echo "Error Occures, Code: ". $e->getCode();
}
?>