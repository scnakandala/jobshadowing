<!DOCTYPE html>
<?php
include_once './config.php';
include_once ROOT_DIR . '/checkAdmin.php';
?>

<h1>Welcome Administrator</h1>
<hr>
<div id="add-sessions" class="div-widgets">
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
<!--<hr>-->
<div id="get-requests" class="div-widgets">
    <h2>Export Pending Requests</h2><br>
    <p>
        You can export the pending requests to an excel sheet and download.
    </p>
    <input type="button" id="export-btn" name="export-btn" value="Export Requests"/>
    <div id="message2"></div>
</div>
<!--<hr>-->
<div id="edit-descriptions" class="div-widgets">
    <h2>Edit Role Descriptions</h2><br>
    <p>
        You can view and edit role descriptions here.
    </p>

    <select id="role-names" name="role-names" size="5"></select>
    <!--<br/><br/>-->
    <div id="role-desc" name="role-desc">
        <p id="role-desc-text"></p>
        <!--<hr/>-->
        <input type="button" id="edit-role-btn" name="edit-role-btn" value="edit"/>
    </div>
    <div style="display: none;text-align: left;" id="dialog-edit" title="Edit Role">
        <p>
            <label>Role ID:</label>
            <b><label id="dialog-role-id"></label></b>
            <br><br>
            <label>Role Name:</label>
            <br>
            <input type="text" id="dialog-role-name" size="30" value=""/>
            <br><br>
            <label>Role Description:</label>            
            <br>
            <textarea id="dialog-role-desc" rows="5"></textarea>
        </p>
    </div>
</div>
<script type="text/javascript" src="./webroot/js/adminJS.js"></script>
