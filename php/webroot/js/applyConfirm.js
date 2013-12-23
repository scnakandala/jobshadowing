
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
                console.log("yes2");
                $(this).dialog("close");
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
        height: 110,
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

    $(document).on("click", ".applyBtn", function(e) {
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

    $(document).on("submit", ".applyForm", function(e) {
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
                        if ($("#ordByComp").hasClass("youarehere")) {
                            $.ajax({
                                url: $('#ordByComp').attr("href"),
                                type: "GET",
                                data: {is_ajax: true},
                                success: function(data)
                                {
                                    $("#main-content").html(data);
                                }
                            });
                        } else {
                            $.ajax({
                                url: $('#ordByRole').attr("href"),
                                type: "GET",
                                data: {is_ajax: true},
                                success: function(data)
                                {
                                    $("#main-content").html(data);
                                }
                            });
                        }
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
});





