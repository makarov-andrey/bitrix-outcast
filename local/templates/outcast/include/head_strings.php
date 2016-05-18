<?
/**
 * @var CMain $APPLICATION
 */
$APPLICATION->addHeadString("<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />");
$APPLICATION->addHeadString("<link rel=\"shortcut icon\" href=\"" . SITE_TEMPLATE_PATH . "/images/favicon.ico\" type=\"image/x-icon\">");
$APPLICATION->setAdditionalCSS(SITE_TEMPLATE_PATH . "/css/main.css");
$APPLICATION->addHeadScript(SITE_TEMPLATE_PATH . "/js/main.js");