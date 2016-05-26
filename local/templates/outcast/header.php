<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/**
 * @var CMain $APPLICATION
 */
?>
<!DOCTYPE html>
<html>
<head lang="en">
	<title><?$APPLICATION->ShowTitle()?></title>
	<?CJSCore::Init();?>
	<?$APPLICATION->ShowHead()?>
	<?$APPLICATION->IncludeFile(PATH_TO_INCLUDE . "/header/head_strings.php")?>
	<?$APPLICATION->IncludeFile(PATH_TO_INCLUDE . "/header/share_meta.php")?>
</head>
<body>
<div style="height: 0; width: 0; position: absolute; visibility: hidden">
	<!-- inject:svg -->
	<svg xmlns="http://www.w3.org/2000/svg"><symbol id="svg-icon-check" viewBox="0 0 24 24"><path d="M0 11.5l1.6-1.6 7.7 4.6L22.6 2 24 3.3 10 22 0 11.5z"/></symbol><symbol id="svg-icon-fb" viewBox="0 0 15.3 33"><path d="M15.3 10.7h-5.2V7.3c0-1.3.9-1.6 1.5-1.6h3.7V0h-5.1C4.5 0 3.3 4.2 3.3 6.9v3.8H0v5.8h3.3V33h6.9V16.5h4.6l.5-5.8z"/></symbol><symbol id="svg-icon-home" viewBox="0 0 412 372"><path d="M369.5 205.8V372H250.7v-90.3h-89.5V372H42.4V205.8H0L206 0l206 205.8h-42.5zM344.1 18.5h-47.9v38.3l47.9 48V18.5z"/></symbol><symbol id="svg-icon-like" viewBox="0 0 512 512"><path d="M77.4 191.5H0v283.8h77.4c14.2 0 25.8-11.6 25.8-25.8V217.3c0-14.2-11.6-25.8-25.8-25.8zM509.7 269.4L495.1 211c-2.9-11.5-13.2-19.5-25-19.5H345.7l9.4-43c4-18.2 6-36.8 6-55.4V62.5c0-14.2-11.6-25.8-25.8-25.8h-25.8c-14.2 0-25.8 11.6-25.8 25.8v25.8c0 71.2-57.8 129-129 129v232.2h59.1c12 0 23.9 2.8 34.6 8.2l18.9 9.5c10.8 5.4 22.6 8.2 34.6 8.2h119.5c10.3 0 19.7-6.1 23.7-15.6l60.4-141c6.9-15.7 8.3-33 4.2-49.4z"/></symbol><symbol id="svg-icon-picture" viewBox="0 0 24 24"><path d="M18.1 16.3c-1-.2-1.9-.4-1.5-1.3 1.4-2.6.4-4-1.1-4s-2.5 1.4-1.1 4c.5.9-.5 1.1-1.5 1.3-1 .2-.9.7-.9 1.7h7c0-1 .1-1.5-.9-1.7zM8 7v17h15V7H8zm13 13H10V9h11v11zM6 18.9L1 5.1 15.1 0l1.8 5h-2.1l-.9-2.5L3.5 6.3 6 13.2v5.7z"/></symbol><symbol id="svg-icon-share" viewBox="0 0 24 24"><path d="M5 7c2.8 0 5 2.2 5 5s-2.2 5-5 5-5-2.2-5-5 2.2-5 5-5zm11.1 12.1c-.1.3-.1.6-.1.9 0 2.2 1.8 4 4 4s4-1.8 4-4-1.8-4-4-4c-1.2 0-2.2.5-2.9 1.3l-5.5-2.9c-.2.6-.5 1.2-.9 1.8-.1-.1 5.4 2.9 5.4 2.9zM24 4c0-2.2-1.8-4-4-4s-4 1.8-4 4c0 .3 0 .6.1.9l-5.5 2.9c.4.6.7 1.2 1 1.8l5.5-2.9c.7.8 1.7 1.3 2.9 1.3 2.2 0 4-1.8 4-4z"/></symbol><symbol id="svg-icon-time" viewBox="0 0 24 24"><path d="M12 2c5.5 0 10 4.5 10 10s-4.5 10-10 10S2 17.5 2 12 6.5 2 12 2zm0-2C5.4 0 0 5.4 0 12s5.4 12 12 12 12-5.4 12-12S18.6 0 12 0zm1 12V6h-2v8h7v-2h-5z"/></symbol><symbol id="svg-icon-vk" viewBox="0 0 38 21.7"><path class="st0" d="M18.6 21.6h2.3s.7-.1 1-.5c.3-.3.3-1 .3-1s0-3 1.4-3.5c1.4-.4 3.2 2.9 5.1 4.2 1.4 1 2.5.8 2.5.8l5.1-.1s2.7-.2 1.4-2.3c-.1-.2-.7-1.5-3.8-4.4-3.2-3-2.8-2.5 1.1-7.6 2.3-3.1 3.3-5 3-5.8-.3-.8-2-.6-2-.6h-5.7s-.4-.1-.7.1c-.4.4-.6.9-.6.9s-.9 2.4-2.1 4.5c-2.5 4.3-3.6 4.5-4 4.3-1-.6-.7-2.5-.7-3.9 0-4.2.6-5.9-1.2-6.4-.7-.2-1.1-.3-2.7-.3-2 0-3.8 0-4.7.5-.7.3-1.2 1-.8 1.1.4.1 1.2.2 1.7.8.5.8.4 2.6.4 2.6s.3 4.9-.8 5.5c-.8.4-1.8-.4-4.1-4.4-1.2-2-2-4.2-2-4.2s-.2-.4-.5-.6C7.2 1 6.7 1 6.7 1H1.2s-.8 0-1.1.4c-.3.3 0 1 0 1s4.3 9.9 9.1 15c4.4 4.5 9.4 4.2 9.4 4.2z"/></symbol></svg>
	<!-- endinject -->
</div>

<main class="<?$APPLICATION->ShowProperty("main-block-class")?>">
	<?$APPLICATION->ShowPanel()?>
	<header>
		<?$APPLICATION->IncludeFile(PATH_TO_INCLUDE . "/header/logo.php")?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:menu",
			"header",
			array(
				"ROOT_MENU_TYPE" => "header",
				"MAX_LEVEL" => "1",
				"USE_EXT" => "N",
				"DELAY" => "N",
				"ALLOW_MULTI_SELECT" => "N",
				"MENU_CACHE_TYPE" => "A"
			)
		);?>

		<div class="logos show-for-large">
			<?$APPLICATION->IncludeFile(PATH_TO_INCLUDE . "/header/fox_logo.php")?>
			<?$APPLICATION->IncludeFile(PATH_TO_INCLUDE . "/header/rostelecom_logo.php")?>
		</div>

        <div class="mobile-menu-link">
            <a href="#"><span class="icon-burger"></span>Меню</a>
        </div>
	</header>
    <?$APPLICATION->IncludeFile(PATH_TO_INCLUDE . "/header/mobile_rostelecom_logo.php")?>