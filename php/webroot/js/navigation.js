$(document).ready(function()
{
    $(document).on("click", "#home-nav", function(e) {
        $('#dialog-wait').dialog("open");
        $.ajax(
                {
                    url: $(this).attr("href"),
                    type: "GET",
                    success: function(data)
                    {
                        $("#tabs").show();
                        $("#main-content").html(data);
                        $('#dialog-wait').dialog("close");
                    }
                });

        e.preventDefault();
    });
    
    $(document).on("click", "#about-nav", function(e) {
        $('#dialog-wait').dialog("open");
        $.ajax(
                {
                    url: $(this).attr("href"),
                    type: "GET",
                    success: function(data)
                    {
                        $("#tabs").hide();
                        $("#main-content").html(data);
                        $('#dialog-wait').dialog("close");
                    }
                });

        e.preventDefault();
    });
    
    $(document).on("click", "#contact-nav", function(e) {
        $('#dialog-wait').dialog("open");
        $.ajax(
                {
                    url: $(this).attr("href"),
                    type: "GET",
                    success: function(data)
                    {
                        $("#tabs").hide();
                        $("#main-content").html(data);
                        $('#dialog-wait').dialog("close");
                    }
                });

        e.preventDefault();
    });
    $(document).on("click", "#admin-nav", function(e) {
        $('#dialog-wait').dialog("open");
        $.ajax(
                {
                    url: $(this).attr("href"),
                    type: "GET",
                    success: function(data)
                    {
                        $("#tabs").hide();
                        $("#main-content").html(data);
                        $('#dialog-wait').dialog("close");
                    }
                });

        e.preventDefault();
    });
});