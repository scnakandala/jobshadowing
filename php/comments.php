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
?>
<html>
    <?php include './html_header.php'; ?>
    <body>       
        <?php include './navbar.php'; ?>
        <div id="mentor-comments">
            <div id="mentor-comments-header">
                 <?php print "<img src='https://graph.facebook.com/".$mentor['1']."/picture'>" ?>
                <h1><?php echo $mentor['0']; ?></h1>
            </div>
            <hr/>
            <div style="display: none" id="fb-root"></div>
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
<!--            <div class="fb-comments" data-href="http://localhost/jobshadowing/comments.php?m_id=<?php echo $com_id; ?>" data-numposts="10" data-colorscheme="light"></div>-->
            <div class="fb-comments" data-href="http://jobshadowing-scn.rhcloud.com/comments.php?m_id=<?php echo $com_id; ?>" data-numposts="10" data-colorscheme="light"></div>
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

