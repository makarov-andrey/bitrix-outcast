<?
/** @var CMain $APPLICATION; */
use BitrixHelper\Component\NewsList;

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

switch ($_GET["sort"]) {
    case "like":
        $sortType = "like";
        break;
    default:
        $sortType = "date";
        break;
}
?>

<form class="gallery-filters">
    <div class="town-select">
        <?$APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "photo_gallery_cities_select",
            array_merge(
                NewsList::getDefaultParams("photogallery", "photogallery_cities"),
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