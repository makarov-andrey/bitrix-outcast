<?
use Preview\Reservation\Model as PreviewReservationModel;

/**
 * Блокирует пользователю возможность резервировать место на предпоказ
 */
AddEventHandler("form", "onAfterResultAdd", array(PreviewReservationModel::class, "blockUserAfterSave"));

/**
 * Сразу после авторизации нужно показать пользователю поп-ап с благодарностью.
 * Параметр сессии используется в SITE_TEMPLATE_PATH/include/gallery_auth_popup.php
 */
AddEventHandler("main", "OnAfterUserAuthorize", function(){
    $_SESSION["show_thank_you_auth"] = true;
});