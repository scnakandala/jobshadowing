<!DOCTYPE html>
<?php
include_once './config.php';

if (isset($_GET['is_ajax']) && $_GET['is_ajax'] == true) {
    include './mentors_list.php';
    exit;
}
?>
<html>
    <head>
        <meta name="og:title" content="Job Shadowing" />
        <?php include './html_header.php'; ?>
        <title>Job Shadowing</title>
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
            <img src="./webroot/images/ajax-loader.gif"/>
        </div>
        <div id="content">                
            <?php
            if (isset($_GET['code'])) {
                $_SESSION['FROM_INDEX'] = true;
                include './select_uni.php';
            } else {
                print '<div id="main-content">';
                $mentors_lists = getMentorsByCompany();
                $minimum = true;
                $count = 0;
                foreach ($mentors_lists as $mentors_list) {
                    $count++;
                    if (empty($mentors_list[1])) {
                        continue;
                    }
                    $org_id = $mentors_list[0][0];
                    print '<div class="company_mentors">';
                    print '<div class="company_name">';
                    print("<h2>" . $mentors_list[0][1] . "</h2>");
                    include './drop_down_menu.php';
                    print '</div>';
                    print '<div class="mentors">';
                    include './mentors_list.php';
                    print '</div>';
                    print '</div>';
                    print '<div class="company_summary">';
                    include './company_summary.php';
                    print '</div>';
                }
                print '</div>';
            }
            ?>`
        </div>            
        <?php include './footer.php'; ?>
        <!--------js scripts------->    
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="./webroot/js/dropit.js"></script>
        <link rel="stylesheet" href="./webroot/css/dropit.css">
        <script>
            $(document).ready(function() {
                $('.menu').dropit();
            });
        </script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <script src="http://malsup.github.com/jquery.form.js"></script>
        <script type="text/javascript" src="http://connect.facebook.net/en_US/all.js"></script>
        <script type="text/javascript" src="./webroot/js/fb-login.js"></script>
        <script type="text/javascript" src="./webroot/js/navigation.js"></script>
        <script type="text/javascript" src="./webroot/js/applyConfirm.js"></script>
        <script type="text/javascript" src="./webroot/js/mentorList.js"></script>
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
    </body>
</html>