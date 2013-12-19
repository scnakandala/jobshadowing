<?php
if (!defined('JOBSHADOWING')) {
    exit;
}

//company not specified
if (empty($org_id)) {
    exit;
}
?>
<div>
    <?php
    $company_name = getOrgName($org_id);
    $company_description = getOrgDescription($org_id);
    $company_vacancies = getMostFrequentJobRoles($org_id);
    $total_vacancies = 0;
    $temp = array();
    foreach ($company_vacancies as $vacancy) {
        $vacancy[2] = getAvailableNumberOfMentors($org_id, $vacancy[0]);
        $total_vacancies += $vacancy[2];
        if($vacancy[2]>0){
            array_push($temp, $vacancy);
        }
    }
    $company_vacancies = $temp;
    
    ?>
    <h2>About&nbsp;<?php print $company_name ?></h2>
    <p>
        <?php print $company_description ?>
    </p>
    <br/>
    <h2>Vacancies - &nbsp;<?php print($total_vacancies) ?></h2>
    <hr/>
    <div>
        <?php
        $temp = false;
        foreach ($company_vacancies as $vacancy) {
            ?>
        <div style="float: left;text-align: center;margin:auto;border: #000000;border-width: 5px; width: 33%">
                <?php print $vacancy[2] ?>
                <br/>
                <a class="company_mentors_link" href="<?php print("./company_mentors.php?org_id=$org_id&role_id=$vacancy[0]") ?>"><?php print $vacancy[1];echo's'; ?></a>
            </div>
            <?php
            $temp = !$temp;
        }
        ?>
    </div>
</div>
