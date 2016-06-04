<?php
	#logout.php

	ini_set('display_errors', 1);

	session_start();

	define('FACEBOOK_SDK_V4_SRC_DIR', __DIR__ . '/facebook-sdk-v4-5/');
	require_once __DIR__ . '/facebook-sdk-v4-5/autoload.php';

	$fb = new Facebook\Facebook([
	'app_id' => '1394209787472659',
	'app_secret' => '93ac859f29768d866fda1cd2e0bd7de0',
	'default_graph_version' => 'v2.0',
	]);
	
	$helper = $fb->getRedirectLoginHelper();  

	$accessToken = null;
	
	try {  
	  $accessToken = $_SESSION['fb_access_token'];  
	} catch(Facebook\Exceptions\FacebookResponseException $e) {  
	  // When Graph returns an error  
	  echo 'Graph returned an error: ' . $e->getMessage();  
	  exit;  
	} catch(Facebook\Exceptions\FacebookSDKException $e) {  
	  // When validation fails or other local issues  
	  echo 'Facebook SDK returned an error: ' . $e->getMessage();  
	  exit;  
	}

	$logoutUrl = 'http://pruthvi-nadunooru.name/MarketPlace/Shield Theme/index.php';

	if(isset($_COOKIE['Picture_Link']) || isset($_COOKIE['UserName']))
	{	
	        $cookieName = 'UserName';
		setcookie($cookieName, "", time() - 15 * 24 * 60 * 60, "/");
		
		$cookieName = 'Picture_Link';
		setcookie($cookieName, "", time() - 15 * 24 * 60 * 60, "/");
		
		$cookieName = 'USER_ID';
		setcookie($cookieName, "", time() - 15 * 24 * 60 * 60, "/");
    	}
    	// redirect
	header( 'Location: ' . $logoutUrl ) ;
?>