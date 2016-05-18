<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');
/**
 * @var CMain $APPLICATION;
 */
CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("404 Not Found");
$APPLICATION->SetPageProperty("main-block-class", "error-404-page")
?>

<div class="content">
	<div class="error-404-wrapper">
		<?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/404.php")?>
	</div>
</div>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>