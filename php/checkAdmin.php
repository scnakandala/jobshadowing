<?php
if (!defined('JOBSHADOWING')) {
    exit;
}

if (!isset($_SESSION['LOGGED_IN']) || ($userInfo['id'] != ADMIN)) {
    header("Location: ./");
}

?>