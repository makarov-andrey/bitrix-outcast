/**
 * Инструмент для шаринга в соц. сети
 */
var Share = new (function(){
    var controller = this;

    /**
     * Проверяет валидность url для шаринга
     * @param {string} url
     */
    function isValidURL (url) {
        return typeof url == "string" && url.length > 0;
    }

    /**
     * Возвращает URL для шаринга с get-параметром для вставки картинки
     * в open-graph разметку.
     * @param {string} url
     * @param {string} image
     * @returns {string}
     */
    function getShareURLWithImage (url, image) {
        var parsedUrl = url.split("?"),
            host = parsedUrl.shift(),
            query = parsedUrl.join("?"),
            shareURLData = {
                share_url: image
            };
        if (query.length > 0) {
            query += "&";
        }
        query += $.param(shareURLData);
        url = host + "?" + query;
        return url;
    }

    /**
     * Форматирует параметры шаринга
     * @param params
     */
    function formatParams (params) {
        if (typeof params != "object") {
            params = {}
        }
        if (!isValidURL(params.url)) {
            params.url = location.origin + location.pathname + location.search;
        }
        if (!params.image) {
            params.image = false;
        }
        return params;
    }

    /**
     * Открывает поп-ап для шаринга во ВКонтакте
     * @param {object} params
     * {
     *     url: {string},
     *     image: {string}
     * }
     */
    controller.vk = function (params) {
        params = formatParams(params);
        var resourceURL  = "http://vkontakte.ru/share.php";
        var vkData = {
            url: params.url
        };
        if (params.image) {
            vkData.image = params.image;
        }
        resourceURL += "?" + $.param(vkData);
        controller.openPopup(resourceURL);
    };

    /**
     * Открывает поп-ап для шаринга в facebook
     * @param {object} params
     * {
     *     url: {string},
     *     image: {string}
     * }
     */
    controller.fb = function (params) {
        params = formatParams(params);
        var resourceURL  = "http://www.facebook.com/sharer.php";
        if (params.image) {
            params.url = getShareURLWithImage(params.url, params.image);
        }
        var fbData = {
            s: 100,
            p: {
                url: params.url
            }
        };
        resourceURL += "?" + $.param(fbData);
        controller.openPopup(resourceURL);
    };

    /**
     * Открывает новое окно браузера для шаринга
     * @param {string} url
     */
    controller.openPopup = function (url) {
        window.open(url, "", "toolbar=0,status=0,width=626,height=436");
    };
});

/**
 * Все кнопки шаринга на сайте.
 *
 * Классы, по нажатию на которые срабатывают триггеры:
 * "js--vk-share" - шаринг во ВКонтакте
 * "js--vk-share" - шаринг в facebook
 *
 * Дата-аттрибуты кнопок:
 * "share-url" - для указания url, на который нужно шарить. По дефолту - текущий url.
 * "share-image" - для указания картинки. По дефолту картинка в разметке open-graph.
 */
$(function(){
    function getShareParams($element) {
        return {
            url: $element.data("shareUrl"),
            image: $element.data("shareImage")
        }
    }

    $(document).on("click", ".js--vk-share", function(){
        var $ctx = $(this),
            params = getShareParams($ctx);
        Share.vk(params);
        return false;
    });

    $(document).on("click", ".js--fb-share", function(){
        var $ctx = $(this),
            params = getShareParams($ctx);
        Share.fb(params);
        return false;
    });
});


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
 * Задает стандартное поведение страницы на ошибочный ответ от сервера
 * при ajax запросах
 */
function defaultAjaxErrorHandler() {
    alert("Извините, произошла внутренняя ошибка сервера.");
}

/**
 * Инициализация динамики на странице /photo-contest/
 */
function initGallery () {
    var $gallery = $(".gallery");

    /**
     * Лайк фотографий
     */
    (function(){
        $(document).on("click", ".js--like", function(){
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
    })();

    /**
     * Подгрузка контента при скролле к концу документа
     */
    (function(){
        /**
         * номер текущей страницы
         * @type {number}
         */
        window.ajaxContentPage = 0;

        /**
         * Хендлер последнего ajax запроса
         * @type jqXHR
         */
        window.ajaxContentLoadingHandler = {readyState: 4};

        /**
         * Вернет true, если нужно подгрузить следующую страницу контента.
         * Для этого галерея должна обязательно иметь класс can-load-content,
         * а предыдущий запрос полностью завершиться
         *
         * @returns {boolean}
         */
        function needToLoadContent () {
            return !$gallery.hasClass("can-load-content") || window.ajaxContentLoadingHandler.readyState != 4;
        }

        $(window).on("ajax-load-content", function loadData () {
            if (needToLoadContent()) {
                return;
            }
            window.ajaxContentPage++;
            var data = $(".gallery-filters").serialize();
            if (window.ajaxContentPageKey) {
                // переменная window.ajaxContentPageKey объявляется в шаблоне компонента
                data += "&" + window.ajaxContentPageKey + "=" + window.ajaxContentPage;
            }
            window.ajaxContentLoadingHandler = $.ajax({
                url: "/ajax/get_gallery_photos.php",
                data: data,
                dataType: "json",
                success: function (response) {
                    if (!response.success) {
                        defaultAjaxErrorHandler();
                        return;
                    }
                    $gallery
                        .append(response.content)
                        .removeClass("content-loading");
                    // переменная window.ajaxContentPagesAmount объявляется в шаблоне компонента
                    if (window.ajaxContentPage >= window.ajaxContentPagesAmount) {
                        $gallery.removeClass("can-load-content");
                    }
                },
                error: defaultAjaxErrorHandler
            });
        }).trigger("ajax-load-content");
    })()
}

/**
 * Инициализация галереи
 */
$(function(){
    var $gallery = $(".gallery");
    if ($gallery.length) {
        initGallery();
    }
});