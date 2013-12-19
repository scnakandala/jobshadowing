<?php
if (!isset($_GET['org_id']) || !isset($_GET['role_id'])) {
    exit;
}

include_once './config.php';

$mentors_list = getAvailableMentors($_GET['org_id'], $_GET['role_id']);
for ($i = 0; $i < count($mentors_list); $i++) {
    $user = $mentors_list[$i];
    ?>
    <div style="padding: 5px;">
        <div>
            <?php print "<img src='https://graph.facebook.com/$user->url/picture'>" ?>
        </div>
        <div>
            <?php
            print "<h3><a href='./comments.php?m_id=" . $user->id . "' class='comment-link' >$user->name</a></h3>";
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
                print "</form>";
            }
            ?>
        </div>
    </div>
    <?php
}
?>