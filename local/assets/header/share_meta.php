<? /** @var CMain $APPLICATION */

$image = "";
$photoId = intval($_GET["share_photo_id"]);
if ($photoId > 0) {
	$image = CFile::GetPath($photoId);
}
if(empty($image)) {
    $image =  SITE_TEMPLATE_PATH . "/images/share-image.jpg";
}
$image = "http://" . $_SERVER["SERVER_NAME"] . $image;
?>
<meta property="og:title" content="<?$APPLICATION->ShowTitle()?>"/>
<meta property="og:description" content="Смотри сериал &laquo;Изгой&raquo; с 4 июня по субботам в 22-00 на канале FOX в Интерактивном ТВ Ростелеком!"/>
<meta property="og:image" content="<?=$image?>"/>