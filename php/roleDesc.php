<?php

include_once './config.php';

$method = $_POST['method'];

switch ($method) {
    case 'getRoles':
        getRolesNames();
        break;
    case 'getDescription':
        getDescription();
        break;
    case 'updateRoleData':
        updateRoleData();
        break;
}

function getRolesNames() {
    $roleNames = getRoles();
    $retString = '';

    foreach ($roleNames as $role) {
        $str = '<option value="' . $role['0'] . '">' . $role['1'] . '</option>';
        $retString = $retString . $str;
    }

    echo $retString;
}

function getDescription() {
    $id = $_POST['role_id'];
    echo getRoleDescription($id);
}

function updateRoleData() {
    $id = $_POST['role_id'];
    $name = $_POST['role_name'];
    $desc = $_POST['role_desc'];
    
    $updated = updateRole($id, $name, $desc);
    if($updated){
        echo 'Role updated successfully.';
    }
    else{
        echo 'Role update failed.';
    }
}
?>

