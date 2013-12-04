<?php
if (!defined('JOBSHADOWING')) {
    exit;
}
?>
<div class="my-navbar" role="navigation">    
    <div class="my-navbar-header">            
        <ul class="my-nav-links">
            <li><a id="home-nav" href="./mentors_list.php?order=company">Job Shadowing</a></li>
            <li><a id="about-nav" href="./about.php">What is Job Shadowing?</a></li>
            <li><a id="contact-nav" href="./contact.php">Contact Us</a></li>
            <?php
            if (isset($_SESSION['LOGGED_IN']) && ($userInfo['id'] == ADMIN)) {
                print '<li><a id="admin-nav" href="/jobshadowing/admin.php">Admin</a></li>';
            }
            ?>

        </ul>
    </div>

    <div class="fb-user">
        <?php if (!isset($_SESSION['LOGGED_IN'])) { ?>
            <a href="<?= $loginUrl ?>">
                <button type="button" class="btn btn-facebook">Login With Facebook</button>
            </a>
        <?php } else { ?>
            <div class="fb-name" id="fb-name">
                Welcome, <a href="<?php echo $userInfo['link']; ?>"> <?php echo $userInfo['name']; ?></a>
                <img src="https://graph.facebook.com/<?php echo $userInfo['id']; ?>/picture" class="fb-image">
                <a href="<?= $logoutUrl ?>">
                    <button type="button" class="btn btn-danger logout-btn">logout</button>
                </a>
            </div>
        <?php } ?>
    </div>
</div>
<br/>