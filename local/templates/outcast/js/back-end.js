/**
 * примененяет параметры и перезагружает страницу сразу после изменения
 * любого инпута в форме на странице бронирования предпоказа
 */
$(function(){
    $(".gallery-filters").on("change", function(){
        $(this).submit();
    });
});

/**
 * Кнопки шаринга в меню шапки
 */
$(function(){
    function openPopup (url) {
        window.open(url, "", "toolbar=0,status=0,width=626,height=436");
    }

    $(".js--vk-share").on("click", function(){
        var shareURL  = "http://vkontakte.ru/share.php?";
        shareURL += "url=" + encodeURIComponent(location.href);
        openPopup(shareURL);
        return false;
    });
    $(".js--fb-share").on("click", function(){
        var shareURL  = "http://www.facebook.com/sharer.php?s=100";
        shareURL += "&p[url]=" + encodeURIComponent(location.href);
        openPopup(shareURL);
        return false;
    });
});

function defaultAjaxErrorHandler() {
    alert("Извините, произошла внутренняя ошибка сервера.");
}
