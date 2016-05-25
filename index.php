<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
/**
 * @var CMain $APPLICATION
 */

$APPLICATION->SetTitle("Главная");
$APPLICATION->SetPageProperty("main-block-class", "main-page")
?>

<div class="content">
    <?$APPLICATION->IncludeFile(PATH_TO_INCLUDE . "/index/hero.php")?>
    <?$APPLICATION->IncludeFile(PATH_TO_INCLUDE . "/throw/events_sidebar.php")?>
</div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
