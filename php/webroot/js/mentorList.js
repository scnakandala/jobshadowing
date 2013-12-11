// A $( document ).ready() block.
$(document).ready(function() {
    $(document).on("click", "#ordByComp", function(e) {
        e.preventDefault();
        var formUrl = $(this).attr("href");
        $('#dialog-wait').dialog("open");
        $.ajax({
            url: formUrl,
            type: "GET",
            data: {is_ajax: true},
            success: function(data)
            {
                $("#main-content").html(data);
                $("#ordByComp").addClass("youarehere");
                $("#ordByRole").removeClass("youarehere");
                $('#dialog-wait').dialog("close");
            }
        });
    });

    $(document).on("click", "#ordByRole", function(e) {
        e.preventDefault();
        var formUrl = $(this).attr("href");
        $('#dialog-wait').dialog("open");
        $.ajax({
            url: formUrl,
            type: "GET",
            data: {is_ajax: true},
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
        var id = $(this).attr("id");
        $('#dialog-wait').dialog("open");
        $.ajax({
            url: formUrl,
            type: "GET",
            data: {is_ajax: true},
            success: function(data)
            {
                id = id.split('_')[0];
                id = "#" + id + "_mentorList";
                $(id).html(data);
                $("#ordByRole").removeClass("youarehere");
                $("#ordByComp").removeClass("youarehere");
                $('#dialog-wait').dialog("close");
            }
        });
    });
});





