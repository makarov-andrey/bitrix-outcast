<?php
/**
 * @var CMain $APPLICATION
 * @var array $arResult
 */

$arShareParams = array();
if (!empty($arResult["OBSESSION"]["SHARE_IMAGE"])) {
    $path = CFile::GetPath($arResult["OBSESSION"]["SHARE_IMAGE"]);
    $arShareParams["image"] = "http://" . $_SERVER["SERVER_NAME"] . $path;
    $arShareParams["photo_id"] = $arResult["OBSESSION"]["SHARE_IMAGE"];
}

$sizes = array(
    "width" => 445,
    "height" => 1000
);
$displayedPicture = CFile::ResizeImageGet($arResult["OBSESSION"]["SHARE_IMAGE"], $sizes);
?>

<div class="test-block">

    <div class="test-result">
        <h1>«<?=$arResult["OBSESSION"]["NAME"]?>»</h1>
        <p><?=$arResult["OBSESSION"]["DESCRIPTION"]?></p>
        <img src="<?=$displayedPicture["src"]?>">
    </div>

    <div class="share-test-results">
        <?$APPLICATION->IncludeFile(PATH_TO_INCLUDE . "/throw/share_buttons.php", $arShareParams)?>
    </div>

</div>