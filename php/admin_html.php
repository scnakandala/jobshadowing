<?php
if (!defined('JOBSHADOWING')) {
    exit;
}
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
        <input type="submit" class="btn white-btn" value="Upload Excel File">
    </form>
    <div id="message"></div>
    <div id="progress">
        <img src="./webroot/images/ajax-loader-bar.gif"/>
    </div>
</div>
<div id="update-request-status" class="div-widgets">
    <h2>Update Request Status</h2><br>
    <p>
        The excel file should have a <b>.xlsx</b> extension. You can <a href="./downloads/templates/requests_template.xlsx">download a template from here</a>.
    </p>
    <form id="update-requests-form" action="updateRequests.php" method="post" enctype="multipart/form-data">
        <input type="file" size="60" name="myfile2">
        <input type="submit" class="btn white-btn" value="Upload Excel File">
    </form>
    <div id="message2"></div>
    <div id="progress2">
        <img src="./webroot/images/ajax-loader-bar.gif"/>
    </div>
</div>
<!--<hr>-->
<div id="get-requests" class="div-widgets">
    <h2>Export Pending Requests</h2><br>
    <p>
        You can export the pending requests to an excel sheet and download.
    </p>
    <form id="export-form" method="post" action="exportRequests.php">
        <input type="submit" class="btn white-btn" id="export-btn" name="export-btn" value="Export & Download Requests"/>
        <br/>         
        <input type="checkbox" id="export-new" name="export-new" value="1"/>
        <label for="export-new" id="export-new-label"> &ensp; Only the New Requests since last export</label>
    </form>
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
        <input type="button" class="btn white-btn" id="edit-role-btn" name="edit-role-btn" value="edit"/>
    </div>
    <div id="dialog-edit" class="edit-dialog" title="Edit Role">
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

<div id="edit-company" class="div-widgets">
    <h2>Edit Company Descriptions</h2><br>
    <p>
        You can view and edit company descriptions here.
    </p>

    <select id="company-names" name="company-names" size="5"></select>
    <div id="company-desc" name="company-desc">
        <p id="company-desc-text"></p>
        <input type="button" class="btn white-btn" id="edit-company-btn" name="edit-company-btn" value="edit"/>
    </div>
    <div class="edit-dialog" id="dialog-edit-company" title="Edit Company">
        <p>
            <label>Company ID:</label>
            <b><label id="dialog-company-id"></label></b>
            <br><br>
            <label>Company Name:</label>
            <br>
            <input type="text" id="dialog-company-name" size="30" value=""/>
            <br><br>
            <label>Company Description:</label>            
            <br>
            <textarea id="dialog-company-desc" rows="5"></textarea>
        </p>
    </div>
</div> 
<script type="text/javascript" src="./webroot/js/adminJS.js"></script>

