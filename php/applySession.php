<?php

include_once './config.php';
include_once ROOT_DIR . '/libs/dbfunctions.php';

$mentor_id = $_POST['mentor_id'];
$user_url = $_POST['user_url'];

$session_id = getLatestSessionId($mentor_id);
$user_id = getUserId($user_url);

$title = "";
$text = "";

$applied = isApplied($session_id, $user_id);
if ($applied) {
    $title = "Already Applied";
    $text = "You have already applied for this session.";
} 
else {
    $added = addRequest($session_id, $user_id);
    if ($added) {
        $title = "Submission Successful";
        $text = "Your application was submitted successfully.";
    } 
    else {
        $title = "Submission Failure";
        $text = "Some error occurred. Please try again.";
    }
}

$retArray = array($title,$text);
echo json_encode($retArray);
?>