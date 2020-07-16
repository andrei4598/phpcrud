<?php
	session_start();
	require_once "GoogleAPI/vendor/autoload.php";
	$gClient = new Google_Client();
	$gClient->setClientId("241191281812-1cthfluqhrn9ge9cgn4amlleh3rhavou.apps.googleusercontent.com");
	$gClient->setClientSecret("qJ3CuO2uhvDVuTHWqCvlx7cY");
	$gClient->setApplicationName("BGnotes");
	$gClient->setRedirectUri("http://localhost/phpcrud/g-callback.php");
	$gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");
?>
