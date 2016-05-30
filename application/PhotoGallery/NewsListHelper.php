<?php

namespace PhotoGallery;


use BitrixHelper\Component\NewsList as BaseNewsListHelper;

class NewsListHelper extends BaseNewsListHelper
{
    const GET_SORT = "sort";
    const GET_CITY_FILTER = "city";

    const SORT_LIKES = "like";

    const GLOBAL_COMPONENT_FILTER_NAME = "galleryComponentFilter";

    /**
     * Возвращает массив
     * 
     * @param bool $watchURL: нужно ли определять сортировку и фильтр из URL
     * @return array
     */
    public static function getDefaultParams ($watchURL = false) 
    {
        $params = array_merge(
            parent::getDefaultParams(Model::IBLOCK_TYPE, Model::IBLOCK_CODE),
            self::getDefaultSort(),
            array(
                "CACHE_TYPE" => "N",
                "FIELD_CODE" => array("DETAIL_PICTURE"),
                "NEWS_COUNT" => 12
            )
        );
        if ($watchURL) {
            self::addSortFromURL($params);
            self::addFilterFromURL($params);
        }
        return $params;
    }

    /**
     * Модифицирует $params по ссылке, добавляя в него сортировку
     * 
     * @param array &$params
     * @return void
     */
    public static function addSortFromURL (&$params) {
        $sortType = self::determineSortType();
        switch ($sortType) {
            case self::SORT_LIKES:
                $sortParams = self::getSortByLikes();
                break;
            default:
                $sortParams = self::getDefaultSort();
                break;
        }
        $params = array_merge($params, $sortParams);
    }

    /**
     * Модифицирует $params по ссылке, добавляя в него фильтр
     * 
     * @param array &$params
     * @return void
     */
    public static function addFilterFromURL (&$params) {
        $city = self::determineCityFilter();
        if (!$city) {
            return;
        }
        $GLOBALS[self::GLOBAL_COMPONENT_FILTER_NAME] = array("PROPERTY_CITY" => $city);
        $filterParams = array("FILTER_NAME" => self::GLOBAL_COMPONENT_FILTER_NAME);
        $params = array_merge($params, $filterParams);
    }

    /**
     * Возвращает тип сортировки из URL
     * 
     * @return string|null
     */
    public static function determineSortType () {
        return isset($_GET[self::GET_SORT]) ? $_GET[self::GET_SORT] : null;
    }

    /**
     * Возвращает id города, по которому нужно отфильтровать
     * 
     * @return int|null
     */
    public static function determineCityFilter () {
        $city = intval($_GET[self::GET_CITY_FILTER]);
        return $city > 0 ? $city : null;
    }

    /**
     * Возвращает сортировку по лайкам
     * 
     * @return array
     */
    public static function getSortByLikes ()
    {
        return array(
            "SORT_BY1" => "PROPERTY_LIKES_AMOUNT",
            "SORT_ORDER1" => "DESC",
            "SORT_BY2" => "SORT",
            "SORT_ORDER2" => "ASC"
        );
    }

    /**
     * Возвращает сортировку по дате
     * 
     * @return array
     */
    public static function getSortByDate ()
    {
        return array(
            "SORT_BY1" => "ACTIVE_FROM",
            "SORT_ORDER1" => "DESC",
            "SORT_BY2" => "SORT",
            "SORT_ORDER2" => "ASC"
        );
    }

    /**
     * Возвращает сортировку по умолчанию
     * 
     * @return array
     */
    public static function getDefaultSort ()
    {
        return self::getSortByDate();
    }
}