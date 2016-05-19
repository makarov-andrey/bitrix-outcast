<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/**
 * @var array $arResult
 */
?>
<?foreach($arResult["ITEMS"] as $arItem):?>
    <a class="events-item <?=$arItem["PROPERTIES"]["ICON"]["VALUE_XML_ID"]?>" href="<?=$arItem["PROPERTIES"]["LINK"]["VALUE"]?>">
        <?if(!empty($arItem["ACTIVE_FROM_FORMATTED"]) || !empty($arItem["ACTIVE_TO_FORMATTED"])):?>
            <span class="events-date">
                <?if(!empty($arItem["ACTIVE_FROM_FORMATTED"])):?>
                    с <?=$arItem["ACTIVE_FROM_FORMATTED"]?>
                <?endif?>
                <?if(!empty($arItem["ACTIVE_TO_FORMATTED"])):?>
                    по <?=$arItem["ACTIVE_TO_FORMATTED"]?>
                <?endif?>
            </span>
        <?endif?>
        <span class="events-title"><?=$arItem["NAME"]?></span>
        <?if(!empty($arItem["PREVIEW_TEXT"])):?>
            <span class="events-caption"><?=$arItem["PREVIEW_TEXT"]?></span>
        <?endif?>
    </a>
<?endforeach?>