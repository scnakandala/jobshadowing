$(document).ready(function()
{
    $("#progress").hide();
    $("#progress2").hide();
    $("#edit-role-btn").hide();
    $("#edit-company-btn").hide();
    getRoles();
    getCompanies();
    
    function getRoles() {
        var formUrl = 'roleDesc.php';
        $.ajax(
                {
                    url: formUrl,
                    type: "POST",
                    data: "method=getRoles",
                    success: function(data, textStatus, jqXHR)
                    {
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
            getCompanies();
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
            "Save":function() {
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
    
    function getCompanies() {
        var formUrl = 'companyDesc.php';
        $.ajax(
                {
                    url: formUrl,
                    type: "POST",
                    data: "method=getCompanies",
                    success: function(data, textStatus, jqXHR)
                    {
//                        console.log(data);
                        $('#company-names').html(data);
                    },
                    error: function(jqXHR, textStatus, errorThrown)
                    {
                        console.log(textStatus);
                    }
                });
    }
    
    $(document).on("change", "#company-names", function(e) {
        var id = $("#company-names").val();
        var formUrl = 'companyDesc.php';
        $.ajax(
                {
                    url: formUrl,
                    type: "POST",
                    data: "method=getDescription&company_id=" + id,
                    beforeSend: function()
                    {
                        $("#edit-company-btn").hide();
                        $('#company-desc-text').html("Please wait...");
                    },
                    success: function(data, textStatus, jqXHR)
                    {
                        $('#company-desc-text').html(data);
                        $("#edit-company-btn").show();
                    },
                    error: function(jqXHR, textStatus, errorThrown)
                    {
                        console.log(textStatus);
                    }
                });

    });
    
    $(document).on("click", "#edit-company-btn", function(e) {
        var id = $("#company-names").val();
        var name = $("#company-names option:selected").text();
        var desc = $('#company-desc-text').html();

        $("#dialog-company-id").html(id);        
        $("#dialog-company-name").attr('value', name);
        $('#dialog-company-desc').val(desc.trim());
        $("#dialog-edit-company").dialog('open');
    });

    $('#dialog-edit-company').dialog({
        autoOpen: false,
        width: 600,
        modal: true,
        resizable: false,
        buttons: {
            "Save": function() {
                $(this).dialog("close");
                updateCompany();
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

    function updateCompany() {
        var formUrl = 'companyDesc.php';
        var id = $("#dialog-company-id").html();
        var name = $("#dialog-company-name").val();
        var desc = $('#dialog-company-desc').val();
//        console.log(id+"::"+name+"::"+desc);
        $.ajax(
                {
                    url: formUrl,
                    type: "POST",
                    data: "method=updateCompanyData&org_id=" + id + "&org_name=" + name + "&org_desc=" + desc,
                    beforeSend: function()
                    {
                        $('#dialog-wait').dialog("open");
                    },
                    success: function(data, textStatus, jqXHR)
                    {
                        $('#dialog-wait').dialog("close");
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
                getCompanies();
    }

});