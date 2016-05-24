<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/**
 * @var CMain $APPLICATION
 * @var array $arResult
 */
?>
<?if(empty($arResult["ITEMS"])):?>
    <h2>В этом городе пока нет фотографий</h2>
    <?return?>
<?endif?>

<script>
    /**
     * Ключ для get-параметра в ajax запросе, отвечающего за номер страницы
     * @type {string}
     */
    window.ajaxContentPageKey = "PAGEN_<?=$arResult["NAV_RESULT"]->NavNum?>";

    /**
     * Конечное количество страниц с фотографиями
     * @type {int}
     */
    window.ajaxContentPagesAmount = <?=$arResult["NAV_RESULT"]->NavPageCount?>;
</script>

<?foreach($arResult["ITEMS"] as $arItem):?>
    <div class="gallery-item column">
        <a href="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>" class="gallery-item-image" data-name="Артём">
            <img src="<?=$arItem["DISPLAY_PICTURE"]["src"]?>" alt="test">
        </a>
        <span class="gallery-item-name"><?=$arItem["NAME"]?></span>
        <div class="share-like-block">
            <a class="share-like-block-side js--like <?=($arItem["LIKED"] ? "liked" : "")?>" data-photo-id="<?=$arItem["ID"]?>">
                <svg class="icon">
                    <use xlink:href="#svg-icon-like"></use>
                </svg>
                <b class="like-index">1</b>
                <span class="likes-count"><?=$arItem["LIKES_AMOUNT"]?></span>
            </a>

            <div class="share-like-block-side text-center share-like-block-sharing">
                <svg class="icon">
                    <use xlink:href="#svg-icon-share"></use>
                </svg>
                <span class="share-like-block-sharing-wrapper">
                    <a href="#">
                        <svg class="icon">
                            <use xlink:href="#svg-icon-vk"></use>
                        </svg>
                    </a>
                    <a href="#">
                        <svg class="icon">
                            <use xlink:href="#svg-icon-fb"></use>
                        </svg>
                    </a>
                </span>
            </div>
        </div>
        <div class="gallery-item-date"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></div>
    </div>
<?endforeach?>