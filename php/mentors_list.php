<?php
include_once './config.php';

$mentors_lists;
if (!isset($_GET['order']) || $_GET['order'] == 'company') {
    $mentors_lists = getMentorsByCompany();
    $ending_s = "";
} else {
    $mentors_lists = getMentorsByRole();
    $ending_s = "s";
}

$max_mentors_per_list = 5;

foreach ($mentors_lists as $mentors_list) {
    if (empty($mentors_list[1])) {
        continue;
    }

    //Takes the mentors with sessions to the top
    usort($mentors_list[1], function($a, $b) {
        return strcmp(empty($a->start), empty($b->start));
    });
    ?>    

    <legend style='padding-top: 20px'><h3><?php print($mentors_list[0][1] . $ending_s) ?></h3></legend>
    <div style="border: 2px solid black;width: 100%; float:left">
        <div style="position: initial;padding: 5px;float: left; width:30%">
            <?php
            for ($i = 0; $i < min(count($mentors_list[1]), $max_mentors_per_list); $i++) {
                $user = $mentors_list[1][$i];
                ?>
                <div style="padding: 5px;">
                    <div>
                        <?php print "<img src='https://graph.facebook.com/$user->url/picture'>" ?>
                    </div>
                    <div>
                        <?php
                        print "<h3><a href='http://www.facebook.com/$user->url' class='question-hyperlink' >$user->name</a></h3>";
                        print "<h4>$user->role at <a href='$user->orgUrl'>$user->org</a></h4>";
                        if (!empty($user->start)) {
                            print "<form id='form_" . $user->id . "' class='applyForm' method='post' action='./applySession.php'>";
                            print "<span>Session on $user->start</span>&nbsp;";
                            print "<input type='hidden' name='mentor_id' id='mentor_id' value='" . $user->id . "' />";
                            print "<input type='hidden' name='session_id' id='session_id' value='" . $user->sessionId . "' />";
                            if ($fbuser) {
                                print "<input type='hidden' name='user_url' id='user_url' value='" . $userInfo['id'] . "' />";
                            }
                            
                            if (isset($_SESSION['LOGGED_IN']) && in_array($user->sessionId, getAppliedSessionIds(getUserId($userInfo['id'])))) {
                                print "<button type='button'>Applied</button>";
                            } else {
                                print "<input type='button' id='btn_" . $user->id . "' value='Apply' class='applyBtn'>";
                            }
                            print "<br/><a href='./comments.php?m_id=".$user->id."' class='comment-link'>View Comments</a>";
                            print "</form>";
                        }
                        ?>
                    </div>
                </div>
                <?php
            }
            if (count($mentors_list[1]) > $max_mentors_per_list) {
                print '<div style="padding:5px">';
                print (count($mentors_list[1]) - $max_mentors_per_list) . " more mentors ";
                print "<a name='see_more' class='see_more_button' href='./full_mentors_list.php/?" . (isset($_GET['order']) && $_GET['order'] == 'role' ? "role=" : "company=")
                        . $mentors_list[0][0] . "'> see all </a>";
                print '</div>';
            }
            ?>
        </div>
        <?php
        if (isset($_GET['order']) && $_GET['order'] == 'role') {
            include './role_summary.php';
        } else {
            include './company_summary.php';
        }
        ?>

    </div>
    <?php
}
?>





