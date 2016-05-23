$(function(){
    $(".js--like").on("click", function(){
        var $ctx = $(this),
            photoId = $ctx.data("photoId");
        $.ajax({
            url: "/ajax/like.php",
            data: {"photo_id": photoId},
            dataType: "json",
            success: function(response) {
                if (!response.success) {
                    defaultAjaxErrorHandler();
                    return;
                }
                $ctx.toggleClass("liked");
                $ctx.find(".likes-count").html(response.amount);
            },
            error: defaultAjaxErrorHandler
        });
    });
});
