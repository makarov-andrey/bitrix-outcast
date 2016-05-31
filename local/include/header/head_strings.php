<?
/**
 * @var CMain $APPLICATION
 */

$APPLICATION->addHeadString("<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />");
$APPLICATION->addHeadString("<link rel=\"shortcut icon\" href=\"" . SITE_TEMPLATE_PATH . "/images/favicon.ico\" type=\"image/x-icon\">");
//$APPLICATION->setAdditionalCSS(SITE_TEMPLATE_PATH . "/css/main.css");
//$APPLICATION->setAdditionalCSS(SITE_TEMPLATE_PATH . "/css/back-end.css");
$APPLICATION->addHeadString("<link rel=\"stylesheet\" href=\"" . SITE_TEMPLATE_PATH . "/css/main.css\">");
$APPLICATION->addHeadString("<link rel=\"stylesheet\" href=\"" . SITE_TEMPLATE_PATH . "/css/back-end.css\">");

$APPLICATION->addHeadScript(SITE_TEMPLATE_PATH . "/js/main.js");
$APPLICATION->addHeadScript(SITE_TEMPLATE_PATH . "/js/back-end.js");
