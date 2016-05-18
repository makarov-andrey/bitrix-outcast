<? require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
/**
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
        <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/gallery_filter.php")?>
        <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/gallery_content.php")?>
    </div>
</div>

<? require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php'); ?>
