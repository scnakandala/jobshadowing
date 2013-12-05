<?php

define('DB_SERVER', getenv("OPENSHIFT_MYSQL_DB_HOST").":".getenv("OPENSHIFT_MYSQL_DB_PORT"));
define('DB_USERNAME', getenv("OPENSHIFT_MYSQL_DB_USERNAME"));
define('DB_PASSWORD', getenv("OPENSHIFT_MYSQL_DB_PASSWORD"));
define('DB_DATABASE', getenv("OPENSHIFT_APP_NAME"));
//define('DB_SERVER', 'localhost');
//define('DB_USERNAME', 'root');
//define('DB_PASSWORD', '');
//define('DB_DATABASE', 'jobshadowing2');

define('ORG','org');
define('ORG_ID','org.id');
define('ORG_NAME','org.name');
define('ORG_URL','org.url');
define('ORG_IS_UNI','org.is_university');

define('USER','user');
define('USER_ID','user.id');
define('USER_NAME','user.name');
define('USER_URL','user.url');
define('USER_ROLE','user.role');
define('USER_ORG','user.org');

define('REQUEST','request');
define('REQUEST_ID','request.id');
define('REQUEST_USER','request.user_id');
define('REQUEST_SESSION','request.session_id');

define('ROLE','role');
define('ROLE_ID','role.id');
define('ROLE_NAME','role.name');
define('ROLE_DESC','role.description');

define('SESSION','session');
define('SESSION_ID','session.id');
define('SESSION_MENTOR','session.mentor');
define('SESSION_START','session.start');

$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die(mysql_error());

$database = mysql_select_db(DB_DATABASE) or die(mysql_error());

?>




