<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
/**
 * @var CMain $APPLICATION
 */

$APPLICATION->SetTitle("Как смотреть");
$APPLICATION->SetPageProperty("main-block-class", "watch-page")
?>

<div class="content">
    <?$APPLICATION->IncludeFile(PATH_TO_INCLUDE . "/how_watch/heading.php")?>
    <?$APPLICATION->IncludeFile(PATH_TO_INCLUDE . "/how_watch/tv.php")?>
    <?$APPLICATION->IncludeFile(PATH_TO_INCLUDE . "/how_watch/connect.php")?>
    <?$APPLICATION->IncludeFile(PATH_TO_INCLUDE . "/how_watch/rostelecom_logo.php")?>
    <?$APPLICATION->IncludeFile(PATH_TO_INCLUDE . "/throw/events_horizontal.php")?>
</div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>

