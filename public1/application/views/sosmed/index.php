<html>
	<head>
		<title>Sosmed</title>
	</head>
	
	<body>
		<?php if(@$user_profile): ?>
			<pre>
				<?php echo print_r($user_profile, TRUE) ?>
			</pre>
			<a href="<?= $logout_url ?>">Logout</a>
		<?php else: ?>
			<h2>Welcome, please login below</h2>
			<a href="<?= $login_url ?>">Login</a>
		<?php endif; ?>
	</body>
</html>
<div id="fb-root"></div>
<script type="text/javascript">// <![CDATA[
window.fbAsyncInit = function() {
FB.init({appId: '533895273426413', status: true, cookie: true,xfbml: true,oauth: true});};
(function() {
var e = document.createElement('script');
e.type = 'text/javascript';
e.src = document.location.protocol+'//connect.facebook.net/en_GB/all.js';
e.async = true;
document.getElementById('fb-root').appendChild(e);
}());
function login()
{
FB.getLoginStatus(function(response) {
if (response.status === 'connected') {
document.location.href = "http://www.mydomain.com/facebook?accessToken="+response.authResponse.accessToken;
}
});
}
// ]]></script> 
  <fb:login-button scope="email" onlogin="login();" >Sign in with Facebook</fb:login-