<? /** @var CMain $APPLICATION */
if (!empty($_GET["share_image"])) {
    $image = $_GET["share_image"];
} else {
    $image = "http://" . $_SERVER["SERVER_NAME"] . SITE_TEMPLATE_PATH . "/images/share-image.jpg";
}
?>
<meta property="og:title" content="<?$APPLICATION->ShowTitle()?>"/>
<meta property="og:description" content="Смотри сериал &laquo;Изгой&raquo; с 4 июня по субботам в 22-00 на канале FOX в Интерактивном ТВ Ростелеком!"/>
<meta property="og:image" content="<?=$image?>"/>