<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/**
 * @var CUser $USER
 * @var array $arResult
 */

use PhotoGallery\Model;
$model = new Model();

$CFile = new CFile();
$pictureSizes = array(
    "width" => 256,
    "height" => 256
);

foreach ($arResult["ITEMS"] as &$arItem) {
    $arItem["DISPLAY_PICTURE"] = $CFile->ResizeImageGet($arItem["DETAIL_PICTURE"], $pictureSizes, BX_RESIZE_IMAGE_EXACT);
    $arItem["LIKED"] = $model->isCurrentUserLiked($arItem["ID"]);
    $arItem["LIKES_AMOUNT"] = $model->countLikes($arItem["ID"]);
    $arItem["SHARE_PARAMS"] = array(
        "photo_id" => $arItem["ID"],
        "image" => "http://" . $_SERVER["SERVER_NAME"] . $arItem["DETAIL_PICTURE"]["SRC"],
    );
}
unset($arItem);

if ($USER->IsAuthorized()) {
    $arResult["LIKE_CLASS"] = "js--like";
} else {
    $arResult["LIKE_CLASS"] = "js--authorize";
}
