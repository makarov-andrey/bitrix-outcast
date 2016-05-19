<?php

namespace Preview\City;

use Application\Base\Model as BaseModel;
use CIBlockElement;

class Model extends BaseModel
{
    protected $dependencies = array("iblock");

    const IBLOCK_CODE = "cities_for_preview";

    /**
     * Возвращает список всех городов для предпоказа
     *
     * @return array
     */
    public function getAll ()
    {
        $sort = self::getDefaultSort();
        $filter = self::getDefaultFilter();
        $select = self::getDefaultSelect();
        $CIBlockElement = new CIBlockElement();
        $dbResult = $CIBlockElement->GetList($sort, $filter, false, false, $select);
        $cities = array();
        while ($city = $dbResult->Fetch()) {
            $cities[] = array(
                "ID" => $city["ID"],
                "NAME" => $city["NAME"],
                "RESERVATIONS_AMOUNT" => $city["PROPERTY_RESERVATIONS_AMOUNT_VALUE"]
            );
        }
        return $cities;
    }

    /**
     * @return array
     */
    public static function getDefaultSort ()
    {
        return array(
            "SORT" => "ASC",
            "NAME" => "ASC"
        );
    }

    /**
     * @return array
     */
    public static function getDefaultFilter ()
    {
        return array(
            "IBLOCK_CODE" => self::IBLOCK_CODE
        );
    }

    /**
     * @return array
     */
    public static function getDefaultSelect ()
    {
        return array(
            "ID",
            "NAME",
            "PROPERTY_RESERVATIONS_AMOUNT"
        );
    }
}