<?php
if (!defined('JOBSHADOWING')) {
    exit;
}

//company not specified
if (empty($org_id)) {
    exit;
}
?>
<div class="company-summary-content">
    <?php
    $company_name = getOrgName($org_id);
    $company_description = getOrgDescription($org_id);
    $company_vacancies = getMostFrequentJobRoles($org_id);
    $total_vacancies = 0;
    $temp = array();
    foreach ($company_vacancies as $vacancy) {
        $vacancy[2] = getAvailableNumberOfMentors($org_id, $vacancy[0]);
        $total_vacancies += $vacancy[2];
        if ($vacancy[2] > 0) {
            array_push($temp, $vacancy);
        }
    }
    $company_vacancies = $temp;
    ?>
    <h2>About&nbsp;<?php print $company_name ?></h2>
    <p class="company-summary-desc">
        <?php print $company_description ?>
    </p>
    <br/>
    <h2>Vacancies - &nbsp;<span class="num-vacancy"><?php print($total_vacancies) ?></span></h2>
    <hr/>
    <div>
        <?php
        $temp = false;
        $index = 0;
        foreach ($company_vacancies as $vacancy) {
            $index++;
            if ($index == 3) {
                $index = 0;
            }

            if ($index == 2) {
                print '<div class="vacancy-box middle-box">';
            } else {
                print '<div class="vacancy-box">';
            }
            ?>            
                <span class="vacancy-box-value"><?php print $vacancy[2] ?></span>
                <br/>

                <a class="company_mentors_link" href="<?php print("./company_mentors.php?org_id=$org_id&role_id=$vacancy[0]") ?>">
    <?php print $vacancy[1];
    echo's';
    ?></a>
            </div>
            <?php
            $temp = !$temp;
        }
        ?>
    </div>
</div>
