<?php

global $galleryComponentSort;

//Сортировка
$_GET["sort"] = isset($_GET["sort"]) ? $_GET["sort"] : null;
switch ($_GET["sort"]) {
    case "like":
        $galleryComponentSort = array(
            "SORT_BY1" => "PROPERTY_LIKES_AMOUNT",
            "SORT_ORDER1" => "DESC",
            "SORT_BY2" => "SORT",
            "SORT_ORDER2" => "ASC"
        );
        break;
    default:
        $galleryComponentSort = array(
            "SORT_BY1" => "ACTIVE_FROM",
            "SORT_ORDER1" => "DESC",
            "SORT_BY2" => "SORT",
            "SORT_ORDER2" => "ASC"
        );
        break;
}