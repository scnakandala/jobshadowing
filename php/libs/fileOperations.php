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
    $success = move_uploaded_file($myFile["tmp_name"], UPLOAD_DIR . $name);
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
        return [];
    }

    $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
    return $sheetData;
}

function writeExcelFile($data) {

    $dateString = date("Y_m_d");
    $filename = "./downloads/exports/Pending_Requests_" . $dateString . ".xlsx";

    $objPHPExcel = new PHPExcel();

    // Set document properties
    $objPHPExcel->getProperties()->setCreator("Job Shadowing Portal")
            ->setTitle("Pending Requests")
            ->setSubject("Pending Requests")
            ->setDescription("Job Shadowing Portal Pending Requests");

// Add some data
    $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Date')
            ->setCellValue('A2', 'Time')
            ->setCellValue('B1', date("Y.m.d"))
            ->setCellValue('B2', date("H:i:s"))
            ->setCellValue('A4', 'Request ID')
            ->setCellValue('B4', 'Session ID')
            ->setCellValue('C4', 'User ID')
            ->setCellValue('D4', 'User Name')
            ->setCellValue('E4', 'User Organization')
            ->setCellValue('F4', 'Mentor ID')
            ->setCellValue('G4', 'Mentor Name')
            ->setCellValue('H4', 'Mentor Organization')
            ->setCellValue('I4', 'Start Date');
    
    for($i=0;$i<count($data);$i++){
        $row = $i+5;
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$row, $data[$i]['0'])
            ->setCellValue('B'.$row, $data[$i]['1'])
            ->setCellValue('C'.$row, $data[$i]['2'])
            ->setCellValue('D'.$row, $data[$i]['3'])
            ->setCellValue('E'.$row, $data[$i]['4'])
            ->setCellValue('F'.$row, $data[$i]['5'])
            ->setCellValue('G'.$row, $data[$i]['6'])
            ->setCellValue('H'.$row, $data[$i]['7'])
            ->setCellValue('I'.$row, $data[$i]['8']);
    }

// Rename worksheet
    $objPHPExcel->getActiveSheet()->setTitle('Pending Requests ' . date("Y.m.d"));


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $objPHPExcel->setActiveSheetIndex(0);

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $saved = $objWriter->save($filename);
    return $filename;
}
?>