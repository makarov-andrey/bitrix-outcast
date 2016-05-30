<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/**
 * @var CMain $APPLICATION
 * @var array $arResult
 */
?>

<div class="mini-gallery owl-carousel">
    <?foreach($arResult["ITEMS"] as $arItem):?>
        <div class="item">
        	<a href="/photo-contest/#photo-<?=$arItem["ID"]?>" class="item">
	            <img src="<?=$arItem["DISPLAY_PICTURE"]["src"]?>" alt="<?=$arItem["NAME"]?>">
	        </a>
            <div class="name"><?=$arItem["NAME"]?></div>
            <div class="date"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></div>
        </div>
    <?endforeach?>
</div>
