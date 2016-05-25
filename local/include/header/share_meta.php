<? /** @var CMain $APPLICATION */
use PhotoGallery\Model as PhotoGalleryModel;
$model = new PhotoGalleryModel();

$image = "";
$photoId = intval($_GET["share_photo_id"]);
if ($photoId > 0) {
	$photo = $model->findPhoto($photoId);
	if (!is_null($photo)) {
		$image = $photo["PICTURE_SRC"];
	}
}
if(empty($image)) {
    $image =  SITE_TEMPLATE_PATH . "/images/share-image.jpg";
}
$image = "http://" . $_SERVER["SERVER_NAME"] . $image;
?>
<meta property="og:title" content="<?$APPLICATION->ShowTitle()?>"/>
<meta property="og:description" content="Смотри сериал &laquo;Изгой&raquo; с 4 июня по субботам в 22-00 на канале FOX в Интерактивном ТВ Ростелеком!"/>
<meta property="og:image" content="<?=$image?>"/>