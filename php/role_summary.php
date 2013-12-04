<?php
if (!defined('JOBSHADOWING')) {
    exit;
}
$companies = getMostFrequentCompanies($mentors_list[0][0]);
foreach($companies as $company) {
?>
<div style="position: initial;padding: 5px;float: right; width:20%;">
    <legend style='padding-top: 20px'><h3><?php echo $company?></h3></legend>
    <?php
    $category = $company;
    include './mentor_summary.php';
    ?>
</div>
<?php
}
?>