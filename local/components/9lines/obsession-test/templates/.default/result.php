<?php
/**
 * @var CMain $APPLICATION
 * @var array $arResult
 */

$arShareParams = array();
if (!empty($arResult["OBSESSION"]["SHARE_IMAGE"])) {
    $arShareParams["image"] = "http://" . $_SERVER["SERVER_NAME"] . $arResult["OBSESSION"]["SHARE_IMAGE"];
}
?>

<div class="test-block">

    <div class="test-result">
        <h1>«<?=$arResult["OBSESSION"]["NAME"]?>»</h1>
        <p><?=$arResult["OBSESSION"]["DESCRIPTION"]?></p>
    </div>

    <div class="share-test-results">
        <?$APPLICATION->IncludeFile(PATH_TO_INCLUDE . "/throw/share_buttons.php", $arShareParams)?>
    </div>

</div>