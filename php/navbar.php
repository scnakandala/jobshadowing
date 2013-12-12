<?php
if (!defined('JOBSHADOWING')) {
    exit;
}
?>
<div class="my-navbar" role="navigation">    
    <div class="my-navbar-header">            
        <a id="home-nav" href="./index.php"><img src="./webroot/images/logo.png"/> </a>
    </div>

    <div class="fb-user">
        <?php if (!isset($_SESSION['LOGGED_IN'])) { ?>
            <a href="<?= $loginUrl ?>">
                <button type="button" class="btn fb-login-btn">Login with Facebook</button>
            </a>
        <?php } else { ?>
            <div class="fb-name" id="fb-name">
                Welcome, <a href="<?php echo $userInfo['link']; ?>"> <?php echo $userInfo['name']; ?></a>
                <img src="https://graph.facebook.com/<?php echo $userInfo['id']; ?>/picture" id="fb-image">
                <a href="<?= $logoutUrl ?>">
                    <button type="button" class="btn logout-btn">logout</button>
                </a>
            </div>
        <?php } ?>
    </div>
</div>
<br/>