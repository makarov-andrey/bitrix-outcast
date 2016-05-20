<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/**
 * @var CMain $APPLICATION
 */?>
	<footer>
		<?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/footer_socials.php")?>
		<?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/footer_mobile_share.php")?>
		<?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/footer_fox_logo.php")?>
		<?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/footer_copyright.php")?>
	</footer>
</main>
<div class="main-loader"></div>
<?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/footer_google_analytics.php")?>
</body>
</html>