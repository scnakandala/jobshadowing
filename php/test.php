<!DOCTYPE html>
<?php
include_once './config.php';

$order = "company";
if (isset($_GET['order'])) {
    $order = $_GET['order'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include './select_uni.php';
}

include './fb-user.php';
?>
<html>
    <?php include './html_header.php'; ?>
    <body class="home-page">
        <div class="container">
            <?php include './navbar.php'; ?>
            <div id="fb-root"></div>     
            <form id ="myForm" name="myForm" method="post" action="testsubmit.php">
                <input id="name" type="text"/>
                <input id="submitForm" type="button" value="apply"/> 
            </form>

            <script>
                $(function() {
                    // jQuery UI Dialog   
                    
                    $('#dialog').dialog({
                        autoOpen: false,
                        width: 400,
                        modal: true,
                        resizable: false,
                        buttons: {
                            "Submit Form": function() {                              
                                    $(this).dialog("close");
                                    $('#myForm').submit();
                                    console.log("submitted");
                            },
                            "Cancel": function() {
                                $(this).dialog("close");
                            }
                        }
                    });

                    $('#submitForm').click(function(e) {
                        e.preventDefault();                        
                        $('#dialog').dialog('open');
                    });
                });

            </script>
            <div id="dialog" title="Empty the recycle bin?">
                <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>These items will be permanently deleted and cannot be recovered. Are you sure?</p>
            </div>
        </div>
    </div>
    <?php include './footer.php'; ?>
</body>
</html>