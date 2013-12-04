<?php

$fbuser = NULL;
try {
    include_once './php-sdk/facebook.php';
} catch (Exception $ex) {
    error_log($ex);
}

$facebook = new Facebook(array(
    'appId' => APP_ID,
    'secret' => APP_SECRET,
    'cookie' => TRUE,
));

$fbuser = $facebook->getUser();
$loginUrl = $facebook->getLoginUrl(array(
    'scope' => 'email',
    'redirect_uri' => REDIRECT_URI
));

$logoutUrl = $facebook->getLogoutUrl(array( 'next' => 'http://localhost/jobshadowing/logout.php' ));

if($fbuser){
    try {
        $user_profile = $facebook->api("/me");
    } catch (Exception $ex) {
        error_log($ex);
        $fbuser = NULL;
    }
}

if($fbuser){
    $userInfo = $facebook->api("/$fbuser");    
}
//{"id":"100007081184011","name":"Dick Amgjhaahdjaa Greenestein","first_name":"Dick","middle_name":"Amgjhaahdjaa","last_name":"Greenestein","link":"https:\/\/www.facebook.com\/profile.php?id=100007081184011","birthday":"08\/08\/1980","gender":"male","email":"hgqqryl_greenestein_1385366430@tfbnw.net","timezone":0,"locale":"en_US","updated_time":"2013-11-25T08:02:16+0000"}
?>
