<?php
include_once './config.php';
include ROOT_DIR . '/libs/classes/PHPExcel.php';

$dateString = date("Y_m_d");
$filename = "Pending_Requests_" . $dateString . ".xlsx";

$requests = getPendingRequests();

$objPHPExcel = new PHPExcel();
// Set document properties
$objPHPExcel->getProperties()->setCreator("Job Shadowing Portal")
        ->setTitle("Pending Requests")
        ->setSubject("Pending Requests")
        ->setDescription("Job Shadowing Portal Pending Requests");
// Add column headings
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

//Add data
for ($i = 0; $i < count($requests); $i++) {
    $row = $i + 5;
    $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A' . $row, $requests[$i]['0'])
            ->setCellValue('B' . $row, $requests[$i]['1'])
            ->setCellValue('C' . $row, $requests[$i]['2'])
            ->setCellValue('D' . $row, $requests[$i]['3'])
            ->setCellValue('E' . $row, $requests[$i]['4'])
            ->setCellValue('F' . $row, $requests[$i]['5'])
            ->setCellValue('G' . $row, $requests[$i]['6'])
            ->setCellValue('H' . $row, $requests[$i]['7'])
            ->setCellValue('I' . $row, $requests[$i]['8']);
}
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Pending Requests ' . date("Y.m.d"));
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$filename.'"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
?>