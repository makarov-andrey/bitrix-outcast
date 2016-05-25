<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
/**
 * @var CMain $APPLICATION
 */
$APPLICATION->SetTitle("Правила");
?>

<div class="content">
    <?$APPLICATION->IncludeFile(PATH_TO_INCLUDE . "/rules/wide_banner.php")?>
    <div class="post-banner-content">
        <div class="container row three-columns-template">
            <div class="column">
                <?$APPLICATION->IncludeFile(PATH_TO_INCLUDE . "/rules/side_nav.php")?>
                <?$APPLICATION->IncludeFile(PATH_TO_INCLUDE . "/rules/side_photo_contest.php")?>
            </div>
            <?$APPLICATION->IncludeFile(PATH_TO_INCLUDE . "/rules/content.php")?>
            <?$APPLICATION->IncludeFile(PATH_TO_INCLUDE . "/throw/events_sidebar.php")?>
        </div>
    </div>
</div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
