<?php

/**
 * Define JOBSHADOWING
 */
define('JOBSHADOWING', 'lkjlkhjd87987dasjh');
define('ADMIN', '100007129573443');


/**
 * Root directory of the folder
 */
define('ROOT_DIR', dirname(__FILE__));
define("UPLOAD_DIR", "./uploads/");
define('ADMIN_URL', ROOT_DIR . '/admin.php');


/*
 * Facebook app details
 */
if (isset(getenv("OPENSHIFT_MYSQL_DB_HOST"))) {
    define('APP_ID', '572241939518439');
    define('APP_SECRET', '724038d2a9ec4c91166975cc2eadb62f');
    define('REDIRECT_URI', 'http://jobshadowing-scn.rhcloud.com/select_uni.php');
} else {
    define('APP_ID', '1411390219096779');
    define('APP_SECRET', 'b6769bb1dc35839de9d9599034229125');
    define('REDIRECT_URI', 'http://localhost/jobshadowing/select_uni.php');
}
/**
 * includes
 */
include_once ROOT_DIR . '/dbconfig.php';
include_once ROOT_DIR . '/libs/classes/Organisation.php';
include_once ROOT_DIR . '/libs/classes/Request.php';
include_once ROOT_DIR . '/libs/classes/Role.php';
include_once ROOT_DIR . '/libs/classes/Session.php';
include_once ROOT_DIR . '/libs/classes/User.php';
include_once ROOT_DIR . '/fb-user.php';
include_once ROOT_DIR . '/libs/dbfunctions.php';
?>