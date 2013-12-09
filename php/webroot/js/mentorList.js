// A $( document ).ready() block.
$(document).ready(function() {
    $("#ordByComp").click(function(e) {
        e.preventDefault();
        var formUrl = $(this).attr("href");
        $('#dialog-wait').dialog("open");
        $.ajax({
            url: formUrl,
            type: "GET",
            success: function(data)
            {
                $("#main-content").html(data);
                $("#ordByComp").addClass("youarehere");
                $("#ordByRole").removeClass("youarehere");
                $('#dialog-wait').dialog("close");
            }
        });
    });

    $("#ordByRole").click(function(e) {
        e.preventDefault();
        var formUrl = $(this).attr("href");
        $('#dialog-wait').dialog("open");
        $.ajax({
            url: formUrl,
            type: "GET",
            success: function(data)
            {
                $("#main-content").html(data);
                $("#ordByRole").addClass("youarehere");
                $("#ordByComp").removeClass("youarehere");
                $('#dialog-wait').dialog("close");
            }
        });
    });

    $(document).on("click", "a.see_more_button", function(e) {
        e.preventDefault();
        var formUrl = $(this).attr("href");
        $('#dialog-wait').dialog("open");
        $.ajax({
            url: formUrl,
            type: "GET",
            success: function(data)
            {
                $("#main-content").html(data);
                $("#ordByRole").removeClass("youarehere");
                $("#ordByComp").removeClass("youarehere");
                $('#dialog-wait').dialog("close");
            }
        });
    });    
});





