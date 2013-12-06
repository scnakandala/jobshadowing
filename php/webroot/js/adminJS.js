$(document).ready(function()
{
    $("#progress").hide();
    $("#progress2").hide();
    $("#edit-role-btn").hide();
    getRoles();
    
    function getRoles() {
        var formUrl = 'roleDesc.php';
        $.ajax(
                {
                    url: formUrl,
                    type: "POST",
                    data: "method=getRoles",
                    success: function(data, textStatus, jqXHR)
                    {
                        console.log(data);
                        $('#role-names').html(data);
                    },
                    error: function(jqXHR, textStatus, errorThrown)
                    {
                        console.log(textStatus);
                    }
                });
    }

    $(document).on("change", "#role-names", function(e) {
        var id = $("#role-names").val();
        var formUrl = 'roleDesc.php';
        $.ajax(
                {
                    url: formUrl,
                    type: "POST",
                    data: "method=getDescription&role_id=" + id,
                    beforeSend: function()
                    {
                        $("#edit-role-btn").hide();
                        $('#role-desc-text').html("Please wait...");
                    },
                    success: function(data, textStatus, jqXHR)
                    {
                        $('#role-desc-text').html(data);
                        $("#edit-role-btn").show();
                    },
                    error: function(jqXHR, textStatus, errorThrown)
                    {
                        console.log(textStatus);
                    }
                });

    });

    $("#add-sessions-form").ajaxForm(options = {
        beforeSend: function()
        {
            $("#progress").show();
            $("#message").html("");
            $("#message").html("Uploading file...");
        },
        success: function()
        {
            $("#progress").hide();
        },
        complete: function(response)
        {
            $("#message").html(response.responseText);
            getRoles();
        },
        error: function()
        {
            $("#message").html("ERROR: unable to upload files");

        }
    }
    );
    
    $("#update-requests-form").ajaxForm(options = {
        beforeSend: function()
        {
            $("#progress2").show();
            $("#message2").html("");
            $("#message2").html("Uploading file...");
        },
        success: function()
        {
            $("#progress2").hide();
        },
        complete: function(response)
        {
            $("#message2").html(response.responseText);
        },
        error: function()
        {
            $("#progress2").hide();
            $("#message2").html("ERROR: unable to upload files");

        }
    }
    );

    $(document).on("click", "#edit-role-btn", function(e) {
        var id = $("#role-names").val();
        var name = $("#role-names option:selected").text();
        var desc = $('#role-desc-text').html();

        $("#dialog-role-id").html(id);        
        $("#dialog-role-name").attr('value', name);
        $('#dialog-role-desc').val(desc.trim());
        $("#dialog-edit").dialog('open');
    });

    $('#dialog-edit').dialog({
        autoOpen: false,
        width: 600,
        modal: true,
        resizable: false,
        buttons: {
            "Save": function() {
                $(this).dialog("close");
                updateRole();
            },
            "Cancel": function() {
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

    function updateRole() {
        var formUrl = 'roleDesc.php';
        var id = $("#dialog-role-id").html();
        var name = $("#dialog-role-name").val();
        var desc = $('#dialog-role-desc').val();
//        console.log(id+"::"+name+"::"+desc);
        $.ajax(
                {
                    url: formUrl,
                    type: "POST",
                    data: "method=updateRoleData&role_id=" + id + "&role_name=" + name + "&role_desc=" + desc,
                    beforeSend: function()
                    {
                        $('#dialog-wait').dialog("open");
                    },
                    success: function(data, textStatus, jqXHR)
                    {
                        $('#dialog-wait').dialog("close");
                        console.log(textStatus);
                        $('#dialog-note').dialog('option', 'title', "Update Status");
                        $('#dialog-note').html(data);
                        $('#dialog-note').dialog('open');
                    },
                    error: function(jqXHR, textStatus, errorThrown)
                    {
                        $('#dialog-wait').dialog("open");
                        console.log(textStatus);
                    }
                });
                getRoles();
    }

});