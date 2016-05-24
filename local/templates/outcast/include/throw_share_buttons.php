<?php
/**
 * @var CMain $APPLICATION
 * @var array $arParams
 */
$dataString = "";
if (isset($arParams["url"])) {
    $param = $arParams["url"];
    $dataString .= " data-share-url=\"$param\"";
}
if (isset($arParams["image"])) {
    $param = $arParams["image"];
    $dataString .= " data-share-image=\"$param\"";
}
if (isset($arParams["photo_id"])) {
    $param = $arParams["photo_id"];
    $dataString .= " data-share-photo-id=\"$param\"";
}
?>

<a href="#" class="js--vk-share"<?=$dataString?>>
    <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/throw_vk_icon.php")?>
</a>
<a href="#" class="js--fb-share"<?=$dataString?>>
    <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/throw_fb_icon.php")?>
</a>
