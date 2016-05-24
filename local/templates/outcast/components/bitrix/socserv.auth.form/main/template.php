<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/**
 * @var Cmain $APPLICATION
 * @var array $arResult
 */
?>

<div class="auth-buttons">
    <?foreach($arResult["AUTH_SERVICES"] as $arService):?>
        <a href="javascript: void(0)" onclick="<?=$arService["ONCLICK"]?>" class="transparent-btn">
            <?$APPLICATION->IncludeFile($arService["ICON_FILE"])?>
            <?=$arService["NAME"]?>
        </a>
    <?endforeach?>
</div>