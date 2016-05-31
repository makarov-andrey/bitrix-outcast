<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
/**
 * @var CMain $APPLICATION
 * @var CUser $USER;
 */

$APPLICATION->SetTitle("Тест");
$APPLICATION->SetPageProperty("main-block-class", "main-page")
?>

<div class="content">
    <?if (!$USER->IsAuthorized()):?>
        <?$APPLICATION->IncludeFile(PATH_TO_INCLUDE . "/obsession_test/auth.php")?>
    <?else:?>
        <?$APPLICATION->IncludeComponent(
            "9lines:obsession-test",
            ""
        )?>
    <?endif?>
</div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
