<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/**
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var CMain $APPLICATION
 * @var array $arResult
 */
?>

<? $APPLICATION->IncludeComponent(
    "bitrix:socserv.auth.form",
    "main",
    array(
        "AUTH_SERVICES" => $arResult["AUTH_SERVICES"],
        "SUFFIX" => "form",
        "require_accept_terms" => $arParams["require_accept_terms"]
    ),
    $component,
    array("HIDE_ICONS" => "Y")
); ?>
<?if($arResult["AUTH_SERVICES"]):?>
    <? $APPLICATION->IncludeComponent(
        "bitrix:socserv.auth.form",
        "",
        array(
            "AUTH_SERVICES" => $arResult["AUTH_SERVICES"],
            "AUTH_URL" => $arResult["AUTH_URL"],
            "POST" => $arResult["POST"],
            "POPUP" => "Y",
            "SUFFIX" => "form",
        ),
        $component,
        array("HIDE_ICONS" => "Y")
    ); ?>
<?endif?>