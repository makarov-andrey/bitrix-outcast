<?
/** @var CMain $APPLICATION */
use Application\Base\Bitrix\Component\NewsList;

global //объявляются в gallery_filter.php
    $galleryComponentSort,
    $galleryComponentFilter;

$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "photo_gallery",
    array_merge(
        NewsList::getDefaultParams("photogallery", "photogallery"),
        $galleryComponentSort,
        array(
            "FIELD_CODE" => array("DETAIL_PICTURE"),
            "NEWS_COUNT" => 9,
            "FILTER_NAME" => "galleryComponentFilter"
        )
    )
);