<?php
if (!isset($_SESSION['LOGGED_IN']) || ($userInfo['id'] != ADMIN)) {
    header("Location: ./");
}

?>