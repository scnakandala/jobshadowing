<?php
if (!defined('JOBSHADOWING')) {
    exit;
}

$count = 0;
foreach ($mentors_list[1] as $user) {
    if ($count == 5) {
        break;
    } else if (($user->role !== $category && $user->org !== $category)) {
        continue;
    } else {
        $count++;
        ?>
        <div style="padding: 5px;">
            <div>
                <?php print "<img src='https://graph.facebook.com/$user->url/picture'>" ?>
            </div>
            <div>
                <?php
                print "<h3><a href='http://www.facebook.com/$user->url' class='question-hyperlink' >$user->name</a></h3>";
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
                    print "</form>";
                }
                print "<br/><a href='./comments.php?m_id=".$user->id."' class='comment-link'>View Comments</a>";
                ?>
            </div>
        </div>
        <?php
    }
}
?>