<?php
if (!isset($_GET['org_id']) || !isset($_GET['role_id'])) {
    exit;
}

include_once './config.php';

$mentors_list = getAvailableMentors($_GET['org_id'], $_GET['role_id']);
for ($i = 0; $i < count($mentors_list); $i++) {
    $user = $mentors_list[$i];
    include './mentor_html.php';
}
?>