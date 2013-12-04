<?php
if (!defined('JOBSHADOWING')) {
    exit;
}
?>
<div id="tabs">
    <?php
    if (isset($_GET['order']) && $_GET['order'] == "role") {
        echo '
        <a id="ordByComp" class="" href="./mentors_list.php/?order=company" title="">Order By Company</a>
        <a id="ordByRole" class="youarehere" href="./mentors_list.php/?order=role" title="">Order By Job Role</a>';
    } else {
        echo '
        <a id="ordByComp" class="youarehere" href="./mentors_list.php/?order=company" title="">Order By Company</a>
        <a id="ordByRole" class="" href="./mentors_list.php/?order=role" title="">Order By Job Role</a>';
    }
    ?>    
</div>
