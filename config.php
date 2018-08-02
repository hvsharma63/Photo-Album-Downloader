<?php
    if(!session_id())
        session_start();
        
    require_once 'Facebook/autoload.php';
    
    $app_id = "1142089132620848";
    $app_secret = "861110cb932af88b2aeecd8351b96eff";
    $permissions = ['email']; // Optional permissions
    $callBackUrl = "http://localhost/FB/fb-callback.php";
    
    $fb = new Facebook\Facebook([
        'app_id' => $app_id, // Replace {app-id} with your app id
        'app_secret' => $app_secret,
        'default_graph_version' => 'v3.1',
    ]);
    
    $helper = $fb->getRedirectLoginHelper();
    
    $loginUrl = $helper->getLoginUrl($callBackUrl, $permissions);
?>