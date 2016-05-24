<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/**
 * @var array $arResult
 * @var array $arParams
 */

$arResult["AUTH_SERVICES"] = array();
foreach($arParams["~AUTH_SERVICES"] as $key => $arService) {
    switch ($key) {
        case "VKontakte":
            $arService["ICON_FILE"] = SITE_TEMPLATE_PATH . "/include/throw_vk_icon.php";
            $arService["NAME"] = "ВКонтакте";
            break;
        case "Facebook":
            $arService["ICON_FILE"] = SITE_TEMPLATE_PATH . "/include/throw_fb_icon.php";
            $arService["NAME"] = "Facebook";
            break;
    }
    preg_match("#onclick=\"(.*?)\"#", $arService['FORM_HTML'], $matches);
    $arService["ONCLICK"] = $matches[1] ? $matches[1] : "BxShowAuthFloat('" . $arService["ID"] . "', '" . $arParams["SUFFIX"] . "')";
    $arResult["AUTH_SERVICES"][$key] = $arService;
}