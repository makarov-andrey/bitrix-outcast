$(function(){
    $(".header-socserv-agree").on("change", function(){
        if ($(this).is(":checked")) {
            $(".header-socserv-button").removeClass("disabled");
        } else {
            $(".header-socserv-button").addClass("disabled");
        }
    });
    $(".sidebar-socserv-agree").on("change", function(){
        if ($(this).is(":checked")) {
            $(".sidebar-socserv-button").removeClass("disabled");
        } else {
            $(".sidebar-socserv-button").addClass("disabled");
        }
    });
});