<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
/**
 * @var CMain $APPLICATION
 */

$APPLICATION->SetTitle("О проекте");
$APPLICATION->SetPageProperty("main-block-class", "about-page")
?>

<div class="content">
    <?$APPLICATION->IncludeFile(PATH_TO_INCLUDE . "/about/video.php")?>
    <?$APPLICATION->IncludeFile(PATH_TO_INCLUDE . "/about/description.php")?>
    <?$APPLICATION->IncludeFile(PATH_TO_INCLUDE . "/throw/events_horizontal.php")?>
</div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>

