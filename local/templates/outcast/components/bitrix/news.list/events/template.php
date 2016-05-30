<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/**
 * @var array $arResult
 */
?>
<?foreach($arResult["ITEMS"] as $arItem):?>
    <?
    $addClasses = $arItem["PROPERTIES"]["ICON"]["VALUE_XML_ID"];
    if ($arItem["PROPERTIES"]["GONE"]["VALUE_XML_ID"] == "Y") {
        $addClasses .= " gone";
    }
    ?>
    <?if(!empty($arItem["PROPERTIES"]["LINK"]["VALUE"])):?>
        <a class="events-item <?=$addClasses?>" href="<?=$arItem["PROPERTIES"]["LINK"]["VALUE"]?>">
    <?else:?>
        <div class="events-item <?=$addClasses?>">
    <?endif?>

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

    <?if(empty($arItem["PROPERTIES"]["LINK"]["VALUE"])):?>
        </div>
    <?else:?>
        </a>
    <?endif?>
<?endforeach?>