<?php
include_once './config.php';

if (!isset($_GET['company'])) {
    exit;
}
$mentors_list = getMentorsOfCompany($_GET['company']);
usort($mentors_list[1], function($a, $b) {
    return strcmp(empty($a->start), empty($b->start));
});
$count = $_GET['company'];
include './mentors_list.php';
?>