<?php

include_once '/../config.php';
if (!defined('JOBSHADOWING')) {
    //   exit;
}

/**
 * Function to get company list
 * 
 * return   array   an aray of (company id,company name)
 */
function getCompanies() {
    $org_ids = array();
    $sql = "select "
            . ORG_ID . "," . ORG_NAME . " from " . ORG . " order by " . ORG_NAME;
    $result = mysql_query($sql);

    while ($row = mysql_fetch_array($result)) {
        array_push($org_ids, array($row[0], $row[1]));
    }

    return $org_ids;
}

/**
 * Function to get mentors grouped by company
 * 
 * return   array   an aray of arrays containing mentors grouped by company
 *                  eg array(array(id,'99XTechnology'), array(Mentor obj1, Mentor obj2))
 */
function getMentorsByCompany() {

    $org_ids = getCompanies();

    $return_result = array();

    foreach ($org_ids as $org) {
        $org_id = $org[0];
        $sql = "select "
                . USER_ID . "," . USER_NAME . "," . USER_URL . ","
                . ROLE_NAME . "," . ORG_NAME . "," . ORG_URL . " from " . USER
                . "," . ROLE . "," . ORG . " where " . USER_ROLE . "="
                . ROLE_ID . " and " . ORG_ID . " = " . USER_ORG . " and "
                . ORG_IS_UNI . " = 0 and "
                . USER_ORG . " = " . $org_id . " order by " . USER_NAME;
        $result = mysql_query($sql);
        $mentors = array();
        while ($row = mysql_fetch_array($result)) {
            list($start, $sessionId) = getSession($row[0]);
            $mentor = new User($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $start, $sessionId);
            array_push($mentors, $mentor);
        }
        array_push($return_result, array($org, $mentors));
    }

    return $return_result;
}

/**
 * Function to get all the mentors of a company
 * 
 * @param int $company_id
 * @return array
 */
function getMentorsOfCompany($company_id) {
    $sql = "select " . ORG_NAME . " from " . ORG . " where " . ORG_ID . " = " . $company_id;
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    $comp_name = $row[0];

    $sql = "select "
            . USER_ID . "," . USER_NAME . "," . USER_URL . ","
            . ROLE_NAME . "," . ORG_NAME . "," . ORG_URL . " from " . USER
            . "," . ROLE . "," . ORG . " where " . USER_ROLE . "="
            . ROLE_ID . " and " . ORG_ID . " = " . USER_ORG . " and "
            . ORG_IS_UNI . " = 0 and "
            . USER_ORG . " = " . $company_id . " order by " . USER_NAME;
    $result = mysql_query($sql);
    $mentors = array();
    while ($row = mysql_fetch_array($result)) {
        list($start, $sessionId) = getSession($row[0]);
        $mentor = new User($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $start, $sessionId);
        array_push($mentors, $mentor);
    }

    return array($comp_name, $mentors);
}

/**
 * Function to get roles list
 * 
 * return   array   an aray of (role id,role name)
 */
function getRoles() {
    $role_ids = array();
    $sql = "select "
            . ROLE_ID . "," . ROLE_NAME . " from " . ROLE . " order by " . ROLE_NAME;
    $result = mysql_query($sql);

    while ($row = mysql_fetch_array($result)) {
        array_push($role_ids, array($row[0], $row[1]));
    }

    return $role_ids;
}

/**
 * Function to get mentors grouped by role
 * 
 * return   array   an aray of arrays containing mentors grouped by job role
 *                  eg array(array(id,'Architecht'), array(Mentor obj1, Mentor obj2))
 */
function getMentorsByRole() {

    $role_ids = getRoles();
    $return_result = array();

    foreach ($role_ids as $role) {
        if ($role[1] == 'Student') {
            continue;
        }
        $role_id = $role[0];
        $sql = "select "
                . USER_ID . "," . USER_NAME . "," . USER_URL . ","
                . ROLE_NAME . "," . ORG_NAME . "," . ORG_URL . " from " . USER . "," . ROLE
                . "," . ORG . " where " . USER_ROLE . "=" . ROLE_ID . " and "
                . ORG_ID . " = " . USER_ORG . " and " . USER_ROLE . " = " . $role_id
                . " order by " . USER_NAME;
        $result = mysql_query($sql);
        $mentors = array();
        while ($row = mysql_fetch_array($result)) {
            list($start, $sessionId) = getSession($row[0]);
            $mentor = new User($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $start, $sessionId);
            array_push($mentors, $mentor);
        }
        array_push($return_result, array($role, $mentors));
    }

    return $return_result;
}

/**
 * Function to get all the mentors of a role
 * 
 * @param int $role_id
 * @return array
 */
function getMentorsOfRole($role_id) {
    $sql = "select " . ROLE_NAME . " from " . ROLE . " where " . ROLE_ID . " = " . $role_id;
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    $role_name = $row[0];

    $sql = "select "
            . USER_ID . "," . USER_NAME . "," . USER_URL . ","
            . ROLE_NAME . "," . ORG_NAME . "," . ORG_URL . " from " . USER . "," . ROLE
            . "," . ORG . " where " . USER_ROLE . "=" . ROLE_ID . " and "
            . ORG_ID . " = " . USER_ORG . " and " . USER_ROLE . " = " . $role_id
            . " order by " . USER_NAME;
    $result = mysql_query($sql);
    $mentors = array();
    while ($row = mysql_fetch_array($result)) {
        list($start, $sessionId) = getSession($row[0]);
        $mentor = new User($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $start, $sessionId);
        array_push($mentors, $mentor);
    }

    return array($role_name, $mentors);
}

/**
 * This function returns the start date and id of the session if open session exits else
 * returns null.
 * A session to be open it should be beyond two months from the current date.
 * 
 * @param int $userId user id
 * 
 */
function getSession($userId) {
    try {
        $sql = "select " . SESSION_START . " , " . SESSION_ID . " from " . SESSION
                . " where " . SESSION_MENTOR . " = " . $userId . " order by "
                . SESSION_START . " desc";
        $result = mysql_fetch_row(mysql_query($sql));
        if (empty($result)) {
            return null;
        } else {
            $time = strtotime($result[0]) - strtotime("now");
            if ($time / (60 * 60 * 24) >= 60) {
                return array($result[0], $result[1]);
            } else {
                return null;
            }
        }
    } catch (Exception $ex) {
        return null;
    }
}

/*
 * This function returns the list of uiversites
 * the format is array(University obj)
 */

function getUniversities() {
    $sql = "select "
            . ORG_ID . "," . ORG_NAME . "," . ORG_URL . ","
            . ORG_IS_UNI . " from " . ORG . " where " . ORG_IS_UNI . "=1";
    $result = mysql_query($sql);
    $universities = array();
    while ($row = mysql_fetch_array($result)) {
        $university = new Organisation($row[0], $row[1], $row[2], $row[3]);
        array_push($universities, $university);
    }
    return $universities;
}

/**
 * This function updates the student information. If the student does not exists
 * creates a new student.
 * @param string $name name
 * @param int    $org  organisation
 * @param int    $url  url
 */
function updateStudentInfo($name, $org, $url) {
    $role = getStudentRoleId();
    $sql = "insert into " . USER . "(" . USER_NAME . "," . USER_ORG . "," . USER_URL . "," . USER_ROLE
            . ") values('$name', $org, $url, $role) on duplicate key update " . USER_NAME . "='$name', "
            . USER_ORG . "=$org, " . USER_ROLE . "=$role";
    if (!mysql_query($sql)) {
        return false;
    } else {
        return true;
    }
}

/**
 * This function returns the id of the Student role
 * 
 * @return int
 */
function getStudentRoleId() {
    $sql = "select " . ROLE_ID . " from " . ROLE . " where " . ROLE_NAME . " = 'Student'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    return $row[0];
}

/**
 * Function to get the latest session id for a mentor
 * 
 * @param int $mentorId mentor id
 * 
 * @return int
 */
function getLatestSessionId($mentorId) {
    $sql = "select " . SESSION_ID . " from " . SESSION . " where " . SESSION_MENTOR
            . " = '" . $mentorId . "' order by " . SESSION_START . " desc";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    return $row[0];
}

/**
 * Function to get the id for a user
 * 
 * @param string $userUrl user url
 * 
 * @return int
 */
function getUserId($userUrl) {
    $sql = "select " . USER_ID . " from " . USER . " where " . USER_URL
            . " = '" . $userUrl . "'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    return $row[0];
}

/**
 * Function to add a new request
 * 
 * @param int $sessionId requested session id
 * @param int $userId id of requesting user
 * 
 * @return string
 */
function addRequest($sessionId, $userId) {
    $sql = "insert into " . REQUEST . " (" . REQUEST_USER . "," . REQUEST_SESSION . ") values ("
            . $userId . "," . $sessionId . ")";
    $result = mysql_query($sql);
    return $result;
}

/**
 * Function to check the existance of a request
 * 
 * @param int $sessionId session id
 * @param int $userId user id
 * 
 * @return boolean
 */
function isApplied($sessionId, $userId) {
    $sql = "select " . REQUEST_ID . " from " . REQUEST . " where " . REQUEST_SESSION
            . " = '" . $sessionId . "' and " . REQUEST_USER
            . " = '" . $userId . "'";
    $result = mysql_query($sql);
    $num_rows = mysql_numrows($result);
    if ($num_rows > 0) {
        return TRUE;
    } else {
        return FALSE;
    }
}

/**
 * Function to check whether the user has already logged in
 * 
 * @param int $url  profile id
 * @return boolean
 */
function checkStudentExists($url) {
    $sql = "select * from " . USER . " where " . USER_URL . " =$url";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);

    if (empty($row)) {
        return false;
    } else {
        return true;
    }
}

/**
 * Function to get all the applied session ids by a user
 * 
 * @param int $userId
 */
function getAppliedSessionIds($userId) {
    $sql = "select " . REQUEST_SESSION .
            " from " . REQUEST . " where " . REQUEST_USER
            . " ='$userId'";

    $result = mysql_query($sql);
    $sessionIds = array();
    while ($row = mysql_fetch_array($result)) {
        array_push($sessionIds, $row[0]);
    }
    return $sessionIds;
}

//var_dump(getAppliedSessions('27'));
function addSession($mentorID, $start) {
    $sql = "insert into " . SESSION . " ( " . SESSION_MENTOR . "," . SESSION_START . ") values ('" .
            $mentorID . "','" . $start . "')";
    $result = mysql_query($sql);
    return $result;
}

function addOrganization($name, $url) {
    $uni = 0;
    $sql = "select " . ORG_ID . " from " . ORG . " where " . ORG_NAME . " = '" . $name . "'";
    $result = mysql_query($sql);
    if (mysql_num_rows($result) > 0) {
        $row = mysql_fetch_array($result);
        return $row['0'];
    } else {
        $sql = "insert into " . ORG . " (" . ORG_NAME . "," . ORG_URL . "," . ORG_IS_UNI . ") values ('" .
                $name . "','" . $url . "','" . $uni . "')";
        $result = mysql_query($sql);
        if ($result) {
            $sql = "select " . ORG_ID . " from " . ORG . " where " . ORG_NAME . " = '" . $name . "'";
            $result = mysql_query($sql);
            $row = mysql_fetch_array($result);
            return $row['0'];
        } else {
            return -1;
        }
    }
}

function addRole($name) {
    $sql = "select " . ROLE_ID . " from " . ROLE . " where " . ROLE_NAME . " = '" . $name . "'";
    $result = mysql_query($sql);
    if (mysql_num_rows($result) > 0) {
        $row = mysql_fetch_array($result);
        return $row['0'];
    } else {
        $sql = "insert into " . ROLE . " ( " . ROLE_NAME . ") values ('" .
                $name . "')";
        $result = mysql_query($sql);
        if ($result) {
            $sql = "select " . ROLE_ID . " from " . ROLE . " where " . ROLE_NAME . " = '" . $name . "'";
            $result = mysql_query($sql);
            $row = mysql_fetch_array($result);
            return $row['0'];
        } else {
            return -1;
        }
    }
}

function addMentor($name, $fb, $org, $role) {
    $sql = "select " . USER_ID . " from " . USER . " where " . USER_URL . " = '" . $fb . "'";
    $result = mysql_query($sql);
    if (mysql_num_rows($result) > 0) {
        $row = mysql_fetch_array($result);
        $id = $row['0'];
        $sql = "update " . USER . " set " . USER_ORG . "=" . $org . "," . USER_ROLE . "=" . $role . " where " . USER_ID . "=" . $id;
        $result = mysql_query($sql);
        if ($result) {
            return $id;
        } else {
            return -1;
        }
    } else {
        $sql = "insert into " . USER . " ( " . USER_NAME . "," . USER_URL . "," . USER_ROLE . "," . USER_ORG . ") values ('" .
                $name . "','" . $fb . "','" . $role . "','" . $org . "')";
        $result = mysql_query($sql);
        if ($result) {
            $sql = "select " . USER_ID . " from " . USER . " where " . USER_URL . " = '" . $fb . "'";
            $result = mysql_query($sql);
            $row = mysql_fetch_array($result);
            return $row['0'];
        } else {
            return -1;
        }
    }
}

/**
 * Function to get the most frequent 3 job roles of an organization
 * @param type $org_id
 * @return array
 */
function getMostFrequentJobRoles($org_id) {
    $sql = "select " . ROLE_NAME . ", count(*) as cnt from " . USER . "," . ROLE
            . "," . ORG . " where " . ORG_ID . " = " . $org_id . " and " . USER_ORG . " = " . ORG_ID .
            " and " . USER_ROLE . " = " . ROLE_ID . " group by " . ROLE_NAME . " order by  cnt desc";
    $result = mysql_query($sql);
    $roles = array();
    $i = 0;
    while ($row = mysql_fetch_array($result)) {
        if ($i == 3) {
            break;
        }
        array_push($roles, $row[0]);
        $i++;
    }

    return $roles;
}


/**
 * Function to get the most frequent 3 companies of a job role
 * @param type $org_id
 * @return array
 */
function getMostFrequentCompanies($role_id) {
    $sql = "select " . ORG_NAME . ", count(*) as cnt from " . USER . "," . ROLE
            . "," . ORG . " where " . ROLE_ID . " = " . $role_id . " and " . USER_ORG . " = " . ORG_ID .
            " and " . USER_ROLE . " = " . ROLE_ID . " and " . ORG_IS_UNI . " = 0" 
            . " group by " . ORG_NAME . " order by  cnt desc";
    $result = mysql_query($sql);
    $companies = array();
    $i = 0;
    while ($row = mysql_fetch_array($result)) {
        if ($i == 3) {
            break;
        }
        array_push($companies, $row[0]);
        $i++;
    }

    return $companies;
}

/**
 * Function to get a list of requests
 * @param boolean $onlyNew if true only the ones with 'Pending' status will be exported
 * @return String
 */
function getPendingRequests($onlyNew) {
    
    $retArray = array();
    $today = date("Y-m-d");
    
    $sql = "select " . REQUEST_ID . " as 'Request_ID',"
            . SESSION_ID . " as 'Session_ID',"
            . "S.id as 'S_ID',"
            . "S.name as 'S_Name',"
            . "SO.name as 'S_Org',"
            . "M.id as 'M_ID',"
            . "M.name as 'M_Name',"
            . "MO.name as 'M_Org',"
            . SESSION_START . " as 'Start_date' "
            . "from " . USER . " as S," . USER . " as M," . REQUEST . "," . SESSION . "," . ORG . " as SO, " . ORG . " as MO "
            . "where ".REQUEST_SESSION."=".SESSION_ID
            . " and ".REQUEST_USER."=S.id"
            . " and ".SESSION_MENTOR."=M.id"
            . " and M.org=MO.id"
            . " and S.org=SO.id"
            . " and ".SESSION_START.">'".$today."'"
            . " and (".REQUEST_STATUS."='Pending'";  
    
    if(!$onlyNew){
        $sql = $sql." or ".REQUEST_STATUS."='Submitted')";
    }
    else{
        $sql = $sql.")";
    }

    $result = mysql_query($sql);
    while($row = mysql_fetch_array($result)){
        array_push($retArray, $row);
    }
    
    return $retArray;    
}

/**
 * Function to change the status of a request
 * @param type $request_id
 * @param type $new_status
 * @return String
 */
function changeRequestStatus($request_id, $new_status){
    $sql = "update ".REQUEST.
            " set ".REQUEST_STATUS."='".$new_status."'".
            " where ".REQUEST_ID."='".$request_id."'";
    $result = mysql_query($sql);
    return $result;
}

/**
 * Function to get the description of a job role
 * @param type $role_id
 * @return String
 */
function getRoleDescription($role_id) {
    $sql = "select " . ROLE_DESC . " from " . ROLE . " where " . ROLE_ID . "=" . $role_id;
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    $desc = $row['0'];
    return $desc;
}

/**
 * Function to update a job role
 * @param type $role_id
 * @param type $role_name
 * @param type $role_desc
 * @return boolean
 */
function updateRole($role_id, $role_name, $role_desc) {
    if (empty($role_name) || empty($role_desc)) {
        return FALSE;
    }
    $sql = 'update ' . ROLE . " set " . ROLE_NAME . "='" . $role_name . "'," . ROLE_DESC . "='" . $role_desc .
            "' where " . ROLE_ID . "='" . $role_id . "'";
    $result = mysql_query($sql);
    return $result;
}

function getMentorName($userID){
    $sql = "select ".USER_NAME.",".USER_URL." from ".USER.",".ROLE." where ".
            USER_ID."='".$userID."' and ".USER_ROLE."=".ROLE_ID." and ".
            ROLE_NAME."!='Student'";
    $result = mysql_query($sql);
    $num_rows = mysql_num_rows($result);
    if($num_rows == 0){
        return array();
    }
    else{
        $rows = mysql_fetch_array($result);
        return array($rows['0'],$rows['1']);
    }    
}

?>