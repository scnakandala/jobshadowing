<?php
include_once './config.php';
include './libs/fileOperations.php';

$requests = getPendingRequests();
//echo json_encode($requests);
if(count($requests) == 0){
    echo 'No pending requests!';
    exit();
}
echo count($requests)." request(s) exported.";
echo '<br/><br/>';
echo "<h3><a href='".writeExcelFile($requests)."'>Download Exported Data</a></h3>";
?>