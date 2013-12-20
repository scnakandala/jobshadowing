<?php
if (!isset($user)) {
    exit;
}
?>
<div class="popup_mentor">
    <div class="mentor_photo">
        <?php print "<img src='https://graph.facebook.com/$user->url/picture'>" ?>
    </div>
    <div class="mentor_info">
        <?php
        print "<a href='./comments.php?m_id=" . $user->id . "' class='comment-link' >$user->name</a><br/>";
        print "$user->role";
        if (!empty($user->start)) {
            print "<form id='form_" . $user->id . "' class='applyForm' method='post' action='./applySession.php'>";
            print "<span>Session on $user->start</span>&nbsp;";
            print "<input type='hidden' name='mentor_id' id='mentor_id' value='" . $user->id . "' />";
            print "<input type='hidden' name='session_id' id='session_id' value='" . $user->sessionId . "' />";
            if ($fbuser) {
                print "<input type='hidden' name='user_url' id='user_url' value='" . $userInfo['id'] . "' />";
            }
            print '<br/>';
            if (isset($_SESSION['LOGGED_IN']) && in_array($user->sessionId, getAppliedSessionIds(getUserId($userInfo['id'])))) {
                print "<button type='button'>connected</button>";
            } else {
                print "<input type='button' id='btn_" . $user->id . "' value='connect' class='applyBtn'>";
            }
            print "</form>";
        }
        ?>
    </div>
</div>