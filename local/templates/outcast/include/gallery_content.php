<?
use Application\Tools;
/**
 * @var CMain $APPLICATION
 */

global //собираются в gallery_filter.php
    $galleryComponentSort,
    $galleryComponentFilter;

$galleryComponentParams["FILTER_NAME"] = "galleryComponentFilter";
$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "photo_gallery",
    array_merge(
        Tools::getDefaultNewsListComponentParams("photogallery", "photogallery"),
        $galleryComponentSort,
        array(
            "FIELD_CODE" => array("DETAIL_PICTURE"),
            "NEWS_COUNT" => 9,
            "FILTER_NAME" => "galleryComponentFilter"
        )
    )
);