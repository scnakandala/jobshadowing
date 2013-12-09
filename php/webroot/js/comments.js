$(function() {
    // jQuery UI Dialog   

    var formId;

    $('#dialog-confirm').dialog({
        autoOpen: false,
        width: 400,
        modal: true,
        resizable: false,
        buttons: {
            "Yes": function() {
                $(this).dialog("close");
                console.log("yes");
                $('#dialog-wait').dialog("open");
                $('#' + formId).submit();
            },
            "No": function() {
                $(this).dialog("close");
            }
        },
        show: {
            effect: "fade",
            duration: 200
        },
        hide: {
            effect: "fade",
            duration: 200
        }

    });

    $('#dialog-note').dialog({
        autoOpen: false,
        width: 400,
        modal: true,
        resizable: false,
        buttons: {
            "OK": function() {
                location.reload(true);
                $(this).dialog("close");
            }
        },
        show: {
            effect: "fade",
            duration: 200
        },
        hide: {
            effect: "fade",
            duration: 200
        }
    });
    $('#dialog-wait').dialog({
        autoOpen: false,
        dialogClass: 'noTitleDialog',
        width: 100,
        height: 90,
        modal: true,
        resizable: false,
        show: {
            effect: "fade",
            duration: 200
        },
        hide: {
            effect: "fade",
            duration: 200
        }
    });

    $(document).on("click", ".applyBtn2", function(e) {
        e.preventDefault();
        if ($("#fb-name").length > 0) {
            var btnId = this.id;
            formId = "form_" + btnId.split("_")[1];
            $('#dialog-confirm').dialog('open');
        }
        else {
            setDialogContent('dialog-note', 'Please Login', 'Please login before applying for a session.');
            $('#dialog-note').dialog('open');
        }
    });

    $(document).on("submit", ".applyForm2", function(e) {
        var postData = $(this).serializeArray();
        var formUrl = $(this).attr("action");
        $.ajax(
                {
                    url: formUrl,
                    type: "POST",
                    data: postData,
                    success: function(data, textStatus, jqXHR)
                    {
                        $('#dialog-wait').dialog("close");
                        var result = eval(data);
                        setDialogContent('dialog-note', result[0], result[1]);
                        $('#dialog-note').dialog('open');
                    },
                    error: function(jqXHR, textStatus, errorThrown)
                    {
                        $('#dialog-wait').dialog("close");
                        setDialogContent('dialog-note', 'Submission Failure', 'Some error occurred. Please try again.');
                        $('#dialog-note').dialog('open');
                    }
                });

        e.preventDefault();
    });

    function setDialogContent(dialogId, titleVal, contentVal) {
        $('#' + dialogId).dialog('option', 'title', titleVal);
        $('#' + dialogId).html(contentVal);
    }

    $("#role-description-tooltip").tooltip({
        show: {
            effect: "slideDown",
            delay: 250
        },
        track: true
    });
});








