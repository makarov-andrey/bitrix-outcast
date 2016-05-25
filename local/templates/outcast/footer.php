<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/**
 * @var CMain $APPLICATION
 */?>
	<footer>
		<?$APPLICATION->IncludeFile(PATH_TO_INCLUDE . "/footer/socials.php")?>
		<?$APPLICATION->IncludeFile(PATH_TO_INCLUDE . "/footer/mobile_share.php")?>
		<?$APPLICATION->IncludeFile(PATH_TO_INCLUDE . "/footer/fox_logo.php")?>
		<?$APPLICATION->IncludeFile(PATH_TO_INCLUDE . "/footer/copyright.php")?>
	</footer>
</main>
<div class="main-loader"></div>
<?$APPLICATION->IncludeFile(PATH_TO_INCLUDE . "/footer/google_analytics.php")?>
</body>
</html>