<?php
//start session


//just simple session reset on logout click
/* if($_GET["reset"]==1)
{
	session_destroy();
	header('Location: ./index.php');
} */

// Include config file and twitter PHP Library by Abraham Williams (abraham@abrah.am)

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
	echo '<a href="processtwitter"><img src="images/sign-in-with-twitter-l.png" width="151" height="24" border="0" /></a>';

}

?>
</div>

</body>
</html>
