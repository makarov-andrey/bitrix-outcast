<?
use Application\Tools;
/**
 * @var CMain $APPLICATION;
 */

global $galleryComponentSort, $galleryComponentFilter;

//Сортировка
$_GET["sort"] = isset($_GET["sort"]) ? $_GET["sort"] : null;
switch ($_GET["sort"]) {
    case "like":
        // TODO сортировка по лайкам
        $sortType = "like";
        $galleryComponentSort = array(
            "SORT_BY1" => "NAME",
            "SORT_ORDER1" => "ASC",
            "SORT_BY2" => "SORT",
            "SORT_ORDER2" => "ASC"
        );
        break;
    default:
        $sortType = "date";
        $galleryComponentSort = array(
            "SORT_BY1" => "ACTIVE_FROM",
            "SORT_ORDER1" => "DESC",
            "SORT_BY2" => "SORT",
            "SORT_ORDER2" => "ASC"
        );
        break;
}

//Фильтрация
$city = intval($_GET["city"]);
if ($city > 0) {
    $galleryComponentFilter = array(
        "PROPERTY_CITY" => $city
    );
}

//Поля сортировки
$sorts = array(
    array(
        "text" => "По дате",
        "value" => "date"
    ),
    array(
        "text" => "Количеству лайков",
        "value" => "like"
    )
);
?>

<form class="gallery-filters">
    <div class="town-select">
        <?$APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "photo_gallery_cities_select",
            array_merge(
                Tools::getDefaultNewsListComponentParams("photogallery", "photogallery_cities"),
                array(
                    "NEWS_COUNT" => 999,
                    "SORT_BY1" => "SORT",
                    "SORT_ORDER1" => "ASC",
                    "SORT_BY2" => "NAME",
                    "SORT_ORDER2" => "ASC"
                )
            )
        );?>
    </div>
    <div class="sort-by">
        <label>Сортировать по:</label>
        <?foreach($sorts as $sort):?>
            <?$checked = $sortType == $sort["value"]?>
            <label class="sort-button transparent-btn <?=($checked ? "active" : "")?>">
                <?=$sort["text"]?>
                <input type="radio" name="sort" value="<?=$sort["value"]?>" <?=($checked ? "checked" : "")?>>
            </label>
        <?endforeach;?>
    </div>
</form>