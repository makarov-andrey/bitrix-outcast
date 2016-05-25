<?
/** @var CMain $APPLICATION */
use Application\Base\Bitrix\Component\NewsList;

$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "events",
    array_merge(
        NewsList::getDefaultParams("content", "events"),
        array(
            "NEWS_COUNT" => 999,
            "PROPERTY_CODE" => array(
                "LINK",
                "ICON"
            )
        )
    )
);