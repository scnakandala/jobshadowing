<?php
if (!isset($mentors_list)) {
    exit;
}
if (isset($minimum)) {
    $max_mentors_per_list = 8;
} else {
    $max_mentors_per_list = 9999; // very large number
}
//Takes the mentors with sessions to the top
usort($mentors_list[1], function($a, $b) {
    return strcmp(empty($a->start), empty($b->start));
});
?>    
<div>
    <div id="<?php print($count . "_mentorList") ?>">
        <?php
        for ($i = 0; $i < min(count($mentors_list[1]), $max_mentors_per_list); $i++) {
            $user = $mentors_list[1][$i];
            ?>
            <div class="left_mentor">
                <?php include './mentor_html.php'; ?>
            </div>
            <?php
            ++$i;
            if ($i == min(count($mentors_list[1]), $max_mentors_per_list)) {
                break;
            }
            $user = $mentors_list[1][$i];
            ?>
            <div class="right_mentor">
                <?php include './mentor_html.php'; ?>
            </div>
            <?php
        }
        if (!empty($minimum) && count($mentors_list[1]) > $max_mentors_per_list) {
            print '<div class="see_more">';
            print '<hr/>';
            $id = $count . '_seeMore';
            print "<a name='see_more' id='$id') class='see_more_button' href='./full_mentors_list.php/?" . (isset($_GET['order']) && $_GET['order'] == 'role' ? "role=" : "company=")
                    . $mentors_list[0][0] . "'> more </a>";
            print '</div>';
        }
        ?>
    </div>
</div>





