<?php

include ROOT_DIR . '/libs/classes/PHPExcel.php';

function uploadFile($myFile, $saveName) {
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
    $name = $saveName . "." . $parts["extension"];

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


function addSessions($sheet) {

    $retArray = array();

    for ($i = 2; $i <= count($sheet); $i++) {
        $row = $sheet[$i];

        $org = $row['A'];
        $org_url = $row['B'];
        $mentor = $row['C'];
        $role = $row['D'];
        $fb = $row['E'];
        $start = $row['F'];

        if (empty($org) || empty($org_url) || empty($mentor) || empty($role) || empty($fb) || empty($start)) {
            array_push($retArray, "Record has invalid values.");
            continue;
        }
        $orgID = addOrganization($org, $org_url);
        $roleID = addRole($role);
        $mentID = addMentor($mentor, $fb, $orgID, $roleID);


        if (($orgID == -1) || ($roleID == -1) || ($mentID == -1)) {
            array_push($retArray, "Session adding failed.");
        } else {
            $added = addSession($mentID, $start);
            if ($added) {
                array_push($retArray, "Session by " . $mentor . " added.");
            } else {
                array_push($retArray, "Session adding failed.");
            }
        }
    }

    return $retArray;
}

function updateRequests($sheet) {

    $retArray = array();

    for ($i = 2; $i <= count($sheet); $i++) {
        $row = $sheet[$i];

        $req_id = $row['A'];
        $req_status = $row['B'];

        if (empty($req_id) || empty($req_status)) {
            array_push($retArray, "Record has invalid values.");
            continue;
        }
        
        $updated = changeRequestStatus($req_id, $req_status);

        if (!$updated) {
            array_push($retArray, "Request ".$req_id." : Status update failed.");
        } else {
            array_push($retArray, "Request ".$req_id." : Status updated to '".$req_status."'.");
        }
    }

    return $retArray;
}
?>