<?php


include_once './config.php';
echo "Hello 1-";
echo ROOT_DIR;
echo "Hello 2";
exit;
include './libs/fileOperations.php';

$uploaded = "";

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

