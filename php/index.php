<!DOCTYPE html>
<?php
include_once './config.php';
?>
<html>
    <?php include './html_header.php'; ?>
    <body>
        <div align="left">
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
            <div style="width:980px;margin:auto">                
                <?php
                if (isset($_GET['code'])) {
                    $_SESSION['FROM_INDEX'] = true;
                    include './select_uni.php';
                } else {
                    print '<div id="tabs" class="subheader">';
                    include './index-tabs.php';
                    print '</div>';
                    print '<div id="main-content">';
                    include './mentors_list.php';
                    print '</div>';
                }
                ?>
            </div>
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
    <script type="text/javascript" src="./webroot/js/applyConfirm.js"></script>
    <script type="text/javascript" src="./webroot/js/mentorList.js"></script>
</body>
</html>