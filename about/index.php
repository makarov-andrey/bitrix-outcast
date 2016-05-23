<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
/**
 * @var CMain $APPLICATION
 */

$APPLICATION->SetTitle("О проекте");
$APPLICATION->SetPageProperty("main-block-class", "about-page")
?>

<div class="content">
    <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/about_video.php")?>
    <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/about_description.php")?>
    <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/throw_events_horizontal.php")?>
</div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>

