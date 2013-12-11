<?php

include_once './config.php';

$method = $_POST['method'];

switch ($method) {
    case 'getCompanies':
        getCompanyNames();
        break;
    case 'getDescription':
        getDescription();
        break;
    case 'updateCompanyData':
        updateOrgData();
        break;
}

function getCompanyNames() {
    $companyNames = getCompanies();
    $retString = '';

    foreach ($companyNames as $company) {
        $str = '<option value="' . $company['0'] . '">' . $company['1'] . '</option>';
        $retString = $retString . $str;
    }

    echo $retString;
}

function getDescription() {
    $id = $_POST['company_id'];
    echo getOrgDescription($id);
}

function updateOrgData() {
    $id = $_POST['org_id'];
    $name = $_POST['org_name'];
    $desc = $_POST['org_desc'];
    
    $updated = updateOrg($id, $name, $desc);
    if($updated){
        echo 'Company updated successfully.';
    }
    else{
        echo 'Company update failed.';
    }
}
?>

