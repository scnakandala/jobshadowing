<?php
setcookie('PHPSESSID', '', time()-100, '/', '');
session_start();
session_destroy();
header('Location: ./');    
?>

