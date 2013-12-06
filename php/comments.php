<!DOCTYPE html>
<?php
include_once './config.php';
if (isset($_GET['m_id'])) {
    $com_id = $_GET['m_id'];
    $mentor = getMentorName($com_id);
    if (empty($mentor)) {
        header('Location: ./');
    }
} else {
    header('Location: ./');
}
if (!isset($_GET['is_ajax']) || (isset($_GET['is_ajax']) && $_GET['is_ajax'] == false)) {
    ?>
    <html>
        <head>
            <meta name="og:title" content="Job Shadowing | <?php echo $mentor['0']; ?>" />
            <meta property="fb:app_id" content="<?php echo APP_ID; ?>"/>
            <?php include './html_header.php'; ?>
            <title>Job Shadowing | <?php echo $mentor['0']; ?></title>
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
            <div id="content">                
                <div style="display: none" id="tabs" class="subheader">
                    <?php include './index-tabs.php'; ?>
                </div>
                <div id="main-content">
                    <?php include './comments_html.php'; ?>
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
<?php
} else {
    include './comments_html.php';
}
?>
