$(document).ready(function()
{
    $("#progress").hide();

    $("#add-sessions-form").ajaxForm(options = {
        beforeSend: function()
        {
            $("#progress").show();
            $("#message").html("");
            $("#message").html("Uploading file...");
        },
        uploadProgress: function(event, position, total, percentComplete)
        {
            $("#bar").width(percentComplete + '%');
            $("#percent").html(percentComplete + '%');
        },
        success: function()
        {
            $("#progress").hide();
        },
        complete: function(response)
        {
            $("#message").html(response.responseText);
        },
        error: function()
        {
            $("#message").html("ERROR: unable to upload files");

        }
    }
    );

    $(document).on("click", "#export-btn", function(e) {
        e.preventDefault();
        console.log("export");
        var formUrl = 'exportRequests.php';
        $.ajax(
                {
                    url: formUrl,
                    type: "POST",
                    data: "",
                    beforeSend: function()
                    {
                        $('#message2').html("Please wait...");
                    },
                    success: function(data, textStatus, jqXHR)
                    {
                        console.log(textStatus);
                        console.log(data);
                        $('#message2').html(data);
                    },
//                    complete: function(response)
//                    {
//                        console.log($('#message2').html());
////                        $currentText = $('#message2').html();
//                         $('#message2').html($('#message2').html()+"<br/>"+response.responseText);
////                        $('#message2').html("Exporting completed successfully!");
//                    },
                    error: function(jqXHR, textStatus, errorThrown)
                    {
                        console.log(textStatus);
//                        $('#dialog-wait').dialog("close");
//                        setDialogContent('dialog-note', 'Submission Failure', 'Some error occurred. Please try again.');
//                        $('#dialog-note').dialog('open');
                    }
                });

    });


});