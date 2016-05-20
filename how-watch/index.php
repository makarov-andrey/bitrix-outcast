<? require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
/**
 * @var CMain $APPLICATION
 */
$APPLICATION->SetTitle("Как смотреть");
$APPLICATION->SetPageProperty("main-block-class", "watch-page")
?>

<div class="content">
    <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/how_watch_heading.php")?>
    <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/how_watch_tv.php")?>
    <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/how_watch_connect.php")?>
    <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/how_watch_rostelecom_logo.php")?>
    <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/throw_events_horizontal.php")?>
</div>

<? require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php'); ?>

