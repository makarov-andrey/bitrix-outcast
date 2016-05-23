<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
/**
 * @var CMain $APPLICATION
 */

$APPLICATION->SetTitle("Главная");
$APPLICATION->SetPageProperty("main-block-class", "main-page")
?>

<div class="content">
    <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/index_hero.php")?>
    <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/throw_events_sidebar.php")?>
</div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
