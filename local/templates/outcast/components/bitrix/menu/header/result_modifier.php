<?
/**
 * @var array $arResult
 */

foreach ($arResult as &$arItem) {
    if (!isset($arItem["PARAMS"]["LINK_CLASS"])) {
        $arItem["PARAMS"]["LINK_CLASS"] = "default-link";
    }
}
unset($arItem);
