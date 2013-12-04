<!DOCTYPE html>
<?php
include_once './config.php';
include_once ROOT_DIR . '/checkAdmin.php';
?>

<h1>Welcome Administrator</h1>
<br>
<hr>
<br>
<div id="add-sessions">
    <h2>Add Mentor Sessions</h2><br>
    <p>
        The excel file should have a <b>.xlsx</b> extension. You can <a href="./downloads/templates/sessions_template.xlsx">download a template from here</a>.
    </p>
    <form id="add-sessions-form" action="addSessions.php" method="post" enctype="multipart/form-data">
        <input type="file" size="60" name="myfile">
        <input type="submit" value="Upload Excel File">
    </form>
    <div id="message"></div>
    <br/>
    <div id="progress">
        <img src="./webroot/images/ajax-loader-bar.gif"/>
    </div>
</div>
<hr>
<div id="get-requests">
    <h2>Export Pending Requests</h2><br>
    <p>
        You can export the pending requests to an excel sheet and download.
    </p>
    <input type="button" id="export-btn" name="export-btn" value="Export Requests"/>
    <div id="message2"></div>
</div>
<script type="text/javascript" src="./webroot/js/adminJS.js"></script>
