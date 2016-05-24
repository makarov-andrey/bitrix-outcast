<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
/**
 * @var CUser $USER
 * @var CMain $APPLICATION
 */

$APPLICATION->SetTitle("Фотоконкурс");
$APPLICATION->SetPageProperty("main-block-class", "gallery-page");
?>

<div class="content">
	<?if($USER->IsAuthorized()):?>
		Вы авторизованы!<br>
		<a href="?logout=YES">Логаут</a>
	<?else:?>
	    <?$APPLICATION->IncludeComponent(
	        "bitrix:system.auth.form",
	        "",
	        Array(
	            "REGISTER_URL" => "",
	            "FORGOT_PASSWORD_URL" => "",
	            "PROFILE_URL" => "",
	            "SHOW_ERRORS" => "N",
	        ),
	        false
	    );?>
	<?endif?>
    <div class="gallery-wrapper row">
        <h1 class="text-uppercase text-center">участвуй в акции в торговых центрах своего города,
            твое фото появится здесь</h1>
        <h3 class="text-center">Набери больше всех лайков и выйграй приз — фирменную футболку!</h3>
        <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/gallery_filter.php")?>
        <div class="gallery row medium-up-3 small-up-1 can-load-content">
            <?//Контент подгружается ajax'ом?>
        </div>
    </div>
</div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
