<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/**
 * @var CUser $USER
 * @var array $arResult
 */

$CFile = new CFile();
$pictureSizes = array(
    "width" => 200,
    "height" => 200
);

foreach ($arResult["ITEMS"] as &$arItem) {
    $arItem["DISPLAY_PICTURE"] = $CFile->ResizeImageGet($arItem["DETAIL_PICTURE"], $pictureSizes, BX_RESIZE_IMAGE_EXACT);
}
unset($arItem);
