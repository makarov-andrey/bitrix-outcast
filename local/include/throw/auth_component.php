<?
/**
 * @var array $arParams
 * @var CMain $APPLICATION
 */
use Application\Tools;

Tools::wrapArrayIfNotItIs($arParams);
$APPLICATION->IncludeComponent(
    "bitrix:system.auth.form",
    "",
    Array(
        "REGISTER_URL" => "",
        "FORGOT_PASSWORD_URL" => "",
        "PROFILE_URL" => "",
        "SHOW_ERRORS" => "N",
        "require_accept_terms" => $arParams["require_accept_terms"]
    ),
    false
);