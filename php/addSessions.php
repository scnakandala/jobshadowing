<?php

include './libs/fileOperations.php';

$uploaded = "";
echo "Hello orld";
exit;
if (!isset($_FILES["myfile"])) {
    $myFile = $_FILES["myfile"];
    $uploaded = uploadFile($myFile);
} else {
    echo 'No file found!';
    exit();
}
echo $uploaded . '<br/><br/>';

if ($uploaded == "File Uploaded Successfully!") {
    echo '<pre>';
    $read = readExcelFile(ROOT_DIR . '/uploads/sessions.xlsx');
    if (count($read) == 0) {
        echo 'Invalid file content';
    } else {
        $results = addSessions($read);
        foreach ($results as $r){
            echo $r;
        }
    }
    echo '</pre>';
}
?>

