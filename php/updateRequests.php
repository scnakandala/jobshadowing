<?php

include_once './config.php';
require ROOT_DIR . '/libs/fileOperations.php';
$uploaded = "";

if (!empty($_FILES["myfile2"])) {
    $myFile = $_FILES["myfile2"];
    $uploaded = uploadFile($myFile,"requests");
} else {
    echo 'No file found!';
    exit();
}
echo $uploaded . '<br/><br/>';

if ($uploaded == "File Uploaded Successfully!") {
    echo '<pre>';
    $read = readExcelFile(UPLOAD_DIR . '/requests.xlsx');
    if (count($read) == 0) {
        echo 'Invalid file content';
    } else {
        $results = updateRequests($read);
        foreach ($results as $r) {
            echo $r."<br/>";
        }
    }
    echo '</pre>';
}
?>

