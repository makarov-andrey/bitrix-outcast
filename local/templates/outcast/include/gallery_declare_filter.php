<?php

global $galleryComponentFilter;

//Фильтрация
$city = intval($_GET["city"]);
if ($city > 0) {
    $galleryComponentFilter = array(
        "PROPERTY_CITY" => $city
    );
}