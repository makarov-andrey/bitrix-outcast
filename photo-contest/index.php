<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
/**
 * @var CUser $USER
 * @var CMain $APPLICATION
 */

$APPLICATION->SetTitle("Фотоконкурс");
$APPLICATION->SetPageProperty("main-block-class", "gallery-page");
?>

<div class="content">
    <div class="gallery-wrapper row">
        <h1 class="text-uppercase text-center">участвуй в акции в торговых центрах своего города,
            твое фото появится здесь</h1>
        <h3 class="text-center">Набери больше всех лайков и выйграй приз — фирменную футболку!</h3>
        <?$APPLICATION->IncludeFile(PATH_TO_INCLUDE . "/gallery/personal_info.php")?>
        <?$APPLICATION->IncludeFile(PATH_TO_INCLUDE . "/gallery/filter.php")?>
        <div class="gallery row medium-up-3 small-up-1 can-load-content">
            <?//Контент подгружается ajax'ом?>
        </div>
    </div>
</div>

<?$APPLICATION->IncludeFile(PATH_TO_INCLUDE . "/gallery/auth_popup.php")?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
