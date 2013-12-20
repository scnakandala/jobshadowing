<?php
include_once './config.php';

if (isset($_GET['filter_role_id']) && isset($_GET['org_id'])) {
    $mentors = getMentorsByOrgAndRole($_GET['org_id'], $_GET['filter_role_id']);
    for ($i = 0; $i < count($mentors); $i++) {
        $user = $mentors[$i];
        ?>
        <div class="left_mentor">
            <?php include './mentor_html.php'; ?>
        </div>
        <?php
        ++$i;
        if ($i == count($mentors)) {
            break;
        }
        $user = $mentors[$i];
        ?>
        <div class="right_mentor">
            <?php include './mentor_html.php'; ?>
        </div>
        <?php
    }
} else if (isset($_GET['org_id'])) {
    $mentors = getMentorsOfCompany($_GET['org_id']);
    for ($i = 0; $i < count($mentors[1]); $i++) {
        $user = $mentors[1][$i];
        ?>
        <div class="left_mentor">
            <?php include './mentor_html.php'; ?>
        </div>
        <?php
        ++$i;
        if ($i == count($mentors[1])) {
            break;
        }
        $user = $mentors[1][$i];
        ?>
        <div class="right_mentor">
            <?php include './mentor_html.php'; ?>
        </div>
        <?php
    }
}
?>
<div class="see_more">
    <br/>
    <hr/>
</div>