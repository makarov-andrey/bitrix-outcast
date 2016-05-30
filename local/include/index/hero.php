<?
use PhotoGallery\NewsListHelper as PhotoGalleryNewsListHelper;
use PhotoGallery\Model;

$iBlockCode = Model::IBLOCK_CODE;
$iBlockType = Model::IBLOCK_TYPE;
?>
<div class="hero-block hero-block-gallery">
    <div class="hero-block-inner">
        <h1>Фотоконкурс</h1>
        <h2>Участвуй в акции в торговых центрах своего города</h2>

        <?$APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "index_photo_gallery",
            PhotoGalleryNewsListHelper::getDefaultParams()
        );?>

        <p><b>Набери больше всех баллов и выиграй приз —
            футболку с Изгоем.</b></p>
        <a href="/photo-contest/" class="blue-btn">Подробнее</a>
    </div>
</div>