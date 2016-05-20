<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/**
 * @var CMain $APPLICATION
 * @var array $arResult
 */?>
<nav class="main-nav">
    <ul>
        <?foreach($arResult as $arItem):?>
            <li class="<?=$arItem["PARAMS"]["LI_CLASS"]?> <?=($arItem["SELECTED"] ? "active" : "")?>">
                <a href="<?=$arItem["LINK"]?>" class="<?=$arItem["PARAMS"]["LINK_CLASS"]?>">
                    <?if(isset($arItem["PARAMS"]["SVG"])):?>
                        <svg>
                            <use xlink:href="<?=$arItem["PARAMS"]["SVG"]?>"></use>
                        </svg>
                    <?endif?>
                    <?=$arItem["TEXT"]?>
                </a>
            </li>
        <?endforeach?>
        <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/header_menu_share.php")?>
    </ul>
</nav>