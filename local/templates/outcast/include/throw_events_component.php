<?
/**
 * @var CMain $APPLICATION
 */
use Application\Tools;
$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "events",
    array_merge(
        Tools::getDefaultNewsListComponentParams("content", "events"),
        array(
            "NEWS_COUNT" => 999,
            "PROPERTY_CODE" => array(
                "LINK",
                "ICON"
            )
        )
    )
);