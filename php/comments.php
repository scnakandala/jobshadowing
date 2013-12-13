<!DOCTYPE html>
<?php
include_once './config.php';
if (isset($_GET['m_id'])) {
    $com_id = $_GET['m_id'];
    $mentor = getMentorDetails($com_id);
    if (empty($mentor)) {
        header('Location: ./');
    }
} else {
    header('Location: ./');
}
//if (!isset($_GET['is_ajax']) || (isset($_GET['is_ajax']) && $_GET['is_ajax'] == false)) {
?>
<html>
    <head>
        <meta name="og:title" content="Job Shadowing | <?php echo $mentor->name; ?>" />
        <meta property="fb:app_id" content="<?php echo APP_ID; ?>"/>
        <?php include './html_header.php'; ?>
        <title>Job Shadowing | <?php echo $mentor->name; ?></title>
    </head>
    <body>
        <?php include './navbar.php'; ?>
        <div style="display: none" id="fb-root"></div>             
        <div style="display: none" id="dialog-confirm" title="Confirm application">
            <p>Do you really want to apply for this session?</p>
        </div>
        <div style="display: none" id="dialog-note" title="">
            <p id="dialog-message"></p>
        </div>
        <div style="display: none" id="dialog-wait" title="">
            <p><b>Please wait...</b></p>
        </div>
        <div id="content">                
            <div id="main-content">
                <?php
//                }
                ?>
                <div id="mentor-comments">
                    <div id="mentor-comments-header">
                        <table id="mentor-details-table">
                            <tr>
                                <td rowspan="7"><img id="comments-mentor-image" src='https://graph.facebook.com/<?php echo $mentor->url; ?>/picture?type=large'></td>
                                <td></td>
                            </tr>
                            <tr>                                
                                <td id="comments-mentor-name"><a href='http://www.facebook.com/<?php echo $mentor->url; ?>'><?php echo $mentor->name; ?></a></td>
                            </tr>
                            <tr>
                                <td id="comments-mentor-role">
                                    <a id="role-description-tooltip" href="" title="<?php echo $mentor->roleDesc; ?>">
                                        <?php echo $mentor->role; ?>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td id="comments-mentor-org">
                                    <a href="<?php echo $mentor->orgUrl; ?>"><?php echo $mentor->org; ?></h3>
                                </td>
                            </tr>                            
                            <tr>
                                <td  id="comments-mentor-session">
                                    <?php
                                    if (!empty($mentor->start)) {
                                        print '<b>Next Session starts on : </b>' . $mentor->start;
                                    } else {
                                        print '<b>No available sessions.</b>';
                                    }
                                    ?>
                                </td>
                            </tr>                            
                            <tr>
                                <td>
                                    <?php
                                    if (!empty($mentor->start)) {
                                        if (isset($_SESSION['LOGGED_IN']) && in_array($mentor->sessionId, getAppliedSessionIds(getUserId($userInfo['id'])))) {
                                            print "<button type='button' class='btn white-btn comments-applied-btn'>Applied</button>";
                                        } else {
                                            print "<form id='form_" . $mentor->id . "' class='applyForm2' method='post' action='./applySession.php'>";
                                            print "<input type='hidden' name='mentor_id' id='mentor_id' value='" . $mentor->id . "' />";
                                            print "<input type='hidden' name='session_id' id='session_id' value='" . $mentor->sessionId . "' />";
                                            if ($fbuser) {
                                                print "<input type='hidden' name='user_url' id='user_url' value='" . $userInfo['id'] . "' />";
                                            }
                                            print "<input type='button' id='btn_" . $mentor->id . "' value='Apply' class='btn white-btn comments-apply-btn'>";
                                            print "</form>";
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr><td></td></tr>
                        </table>
                    </div>
                    <hr/>
                    <div style="display: none" id="fb-root"></div>
                    <?php
                    if (true || getenv("OPENSHIFT_APP_NAME")) {
                        print '<div class="fb-comments" data-href="http://jobshadowing-scn.rhcloud.com/comments.php?m_id=' . $com_id . '" data-numposts="10" data-colorscheme="light"></div>';
                    } else {
                        print '<div class="fb-comments" data-href="http://localhost/jobshadowing/php/comments.php?m_id=' . $com_id . '" data-numposts="10" data-colorscheme="light"></div>';
                    }
                    ?>
                </div>
                <script type="text/javascript" src="./webroot/js/fb-login.js"></script>
                <script>
                    (function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id))
                            return;
                        js = d.createElement(s);
                        js.id = id;
                        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=1411390219096779";
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));
                </script>
                <script type="text/javascript" src="./webroot/js/comments.js"></script>
                <?php
//                if (!isset($_GET['is_ajax']) || (isset($_GET['is_ajax']) && $_GET['is_ajax'] == false)) {
                ?>
            </div>
        </div>
        <?php include './footer.php'; ?>
        <!--------js scripts------->    
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <script src="http://malsup.github.com/jquery.form.js"></script>
        <script type="text/javascript" src="http://connect.facebook.net/en_US/all.js"></script>
        <script type="text/javascript" src="./webroot/js/fb-login.js"></script>
        <script type="text/javascript" src="./webroot/js/navigation.js"></script>
        <!--<script type="text/javascript" src="./webroot/js/applyConfirm.js"></script>-->
        <script type="text/javascript" src="./webroot/js/mentorList.js"></script>
    </body>
</html>
<?php
//}
?>
