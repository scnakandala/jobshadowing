<?php
if (!defined('JOBSHADOWING')) {
    exit;
}
?>
<div id="footer">
    <div id="copyright"><a href="http://www.99xtechnology.com/">99X TECHNOLOGY</a></div>
    <div id="nav-links">
        <ul>
            <?php
            if (isset($_SESSION['LOGGED_IN']) && ($userInfo['id'] == ADMIN)) {
                print '<li><a id="admin-nav" href="./admin.php">Administrator</a></li>';
                print '<li>-</li>';
            }
            ?>            
            <li><a id="about-nav" href="./about.php">About Us</a></li>
            <li>-</li>
            <li><a id="contact-nav" href="./contact.php">Contact Us</a></li>
        </ul>
    </div>
</div>