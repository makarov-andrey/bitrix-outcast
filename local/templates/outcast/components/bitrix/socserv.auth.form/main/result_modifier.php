<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$arResult["AUTH_SERVICES"] = array();
foreach($arParams["~AUTH_SERVICES"] as $key => $arService) {
    switch ($key) {
        case "VKontakte":
            $arService["CLASS"] = "vk";
            break;
        case "Facebook":
            $arService["CLASS"] = "fb";
            break;
    }
    preg_match("#onclick=\"(.*?)\"#", $arService['FORM_HTML'], $matches);
    $arService["ONCLICK"] = $matches[1] ? $matches[1] : "BxShowAuthFloat('" . $arService["ID"] . "', '" . $arParams["SUFFIX"] . "')";
    unset($matches);
    $arResult["AUTH_SERVICES"][$key] = $arService;
}