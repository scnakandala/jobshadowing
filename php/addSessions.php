<?php

include_once './config.php';
require ROOT_DIR . '/libs/fileOperations.php';
$uploaded = "";

if (!empty($_FILES["myfile"])) {
    $myFile = $_FILES["myfile"];
    $uploaded = uploadFile($myFile,"sessions");
} else {
    echo 'No file found!';
    exit();
}
echo $uploaded . '<br/><br/>';

if ($uploaded == "File Uploaded Successfully!") {
    echo '<pre>';
    $read = readExcelFile(UPLOAD_DIR . '/sessions.xlsx');
    if (count($read) == 0) {
        echo 'Invalid file content';
    } else {
        $results = addSessions($read);
        foreach ($results as $r) {
            echo $r."<br/>";
        }
    }
    echo '</pre>';
}
?>

