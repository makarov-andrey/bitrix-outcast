<?
/** @var CMain $APPLICATION */
use Application\Base\Bitrix\Component\NewsList;
use PhotoGallery\Model;

include __DIR__ . "/declare_filter.php";
include __DIR__ . "/declare_sort.php";

global $galleryComponentSort, $galleryComponentFilter;

$iBlockCode = Model::IBLOCK_CODE;
$iBlockType = Model::IBLOCK_TYPE;


$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "photo_gallery",
    array_merge(
        NewsList::getDefaultParams($iBlockType, $iBlockCode),
        $galleryComponentSort,
        array(
            "FIELD_CODE" => array("DETAIL_PICTURE"),
            "NEWS_COUNT" => 12,
            "FILTER_NAME" => "galleryComponentFilter"
        )
    )
);