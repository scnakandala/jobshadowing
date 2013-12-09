<?php
include_once './config.php';

if (!isset($_GET['is_ajax']) || (isset($_GET['is_ajax']) && $_GET['is_ajax'] == false)) {
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
                <div id="tabs" class="subheader">
                    <?php include './index-tabs.php' ?>
                </div>
                <div id="main-content">
                    <?php include './about_html.php';?>
                </div>
            </div>
            <?php include './footer.php'; ?>

            <!--------js scripts------->    
            <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
            <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
            <script src="http://malsup.github.com/jquery.form.js"></script>
            <script type="text/javascript" src="http://connect.facebook.net/en_US/all.js"></script>
            <script type="text/javascript" src="./webroot/js/fb-login.js"></script>
            <!--<script type="text/javascript" src="./webroot/js/navigation.js"></script>-->
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
    <?php
} else {
    include './about_html.php';
}
?>