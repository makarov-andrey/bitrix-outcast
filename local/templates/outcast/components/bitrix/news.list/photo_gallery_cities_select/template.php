<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/**
 * @var CMain $APPLICATION
 * @var array $arResult
 */
?>
<label for="gallery_filter_city">Выбери свой город:</label>
<div class="transparent-select">
    <select name="city" id="gallery_filter_city">
        <option>Любой город</option>
        <?foreach($arResult["ITEMS"] as $arItem):?>
            <option value="<?=$arItem["ID"]?>" <?=($_GET["city"] == $arItem["ID"] ? "selected" : "")?>><?=$arItem["NAME"]?></option>
        <?endforeach?>
    </select>
</div>