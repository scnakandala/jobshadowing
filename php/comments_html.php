<?php
if (!defined('JOBSHADOWING')) {
    exit;
}
?>
<div id="mentor-comments">
    <div id="mentor-comments-header">
        <?php print "<img src='https://graph.facebook.com/" . $mentor['1'] . "/picture?type=large'>" ?>
        <h1><?php echo $mentor['0']; ?></h1>
    </div>
    <hr/>
    <div style="display: none" id="fb-root"></div>
    <?php
    if (true || getenv("OPENSHIFT_APP_NAME")) {
        print '<div class="fb-comments" data-href="http://jobshadowing-scn.rhcloud.com/comments.php?m_id=' . $com_id . ' " data-numposts="10" data-colorscheme="light"></div>';
    } else {
        print '<div class="fb-comments" data-href="http://localhost/jobshadowing/php/comments.php?m_id=' . $com_id . ' " data-numposts="10" data-colorscheme="light"></div>';
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
