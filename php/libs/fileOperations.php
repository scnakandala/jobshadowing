<?php
include ROOT_DIR . '/libs/classes/PHPExcel.php';


function uploadFile($myFile) {
    if ($myFile["error"] !== UPLOAD_ERR_OK) {
        return "File upload failed!";
        exit;
    }

    // ensure a safe filename    
    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);
    $parts = pathinfo($name);

    //make sure that the uploaded file is an excel file    
    if ($parts["extension"] != 'xlsx') {
        return "Wrong file type!";
    }

    //change the file name to 'sessions'
    $name = "sessions." . $parts["extension"];

    // preserve file from temporary directory
    $success = move_uploaded_file($myFile["tmp_name"], UPLOAD_DIR . "/" . $name);
    if (!$success) {
        return "File upload failed!";
        exit;
    } else {
        return "File Uploaded Successfully!";
    }
}

function readExcelFile($filename) {

    $inputFileName = $filename;  // File to read
    try {
        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
    } catch (Exception $e) {
        return array();
    }

    $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
    return $sheetData;
}

?>