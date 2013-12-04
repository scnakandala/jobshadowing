<?php
if (!defined('JOBSHADOWING')) {
    exit;
}
$roles = getMostFrequentJobRoles($mentors_list[0][0]);
foreach ($roles as $role) {
?>
<div style="position: initial;padding: 5px;float: right; width:20%;">
    <legend style='padding-top: 20px'><h3><?php echo $role?>s</h3></legend>
    <?php
    $category = $role;
    include './mentor_summary.php';
    ?>
</div>
<?php
}
?>