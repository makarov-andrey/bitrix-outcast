<?php

namespace Preview\City;

use Application\Base\Bitrix\Model\IBlockElement as BaseIBlockElementModel;

class Model extends BaseIBlockElementModel
{
    const IBLOCK_CODE = "cities_for_preview";

    /**
     * @return string
     */
    public function getIBlockCode ()
    {
        return static::IBLOCK_CODE;
    }

    /**
     * @param $city
     * @return array
     */
    public function formatDBResult ($city)
    {
        return array(
            "ID" => $city["ID"],
            "NAME" => $city["NAME"],
            "RESERVATIONS_AMOUNT" => $city["PROPERTY_RESERVATIONS_AMOUNT_VALUE"],
            "ADDRESS" => $city["PROPERTY_ADDRESS_VALUE"],
            "TIME" => $city["PROPERTY_TIME_VALUE"]
        );
    }

    /**
     * @return array
     */
    public function getDefaultSort ()
    {
        return array(
            "SORT" => "ASC",
            "NAME" => "ASC"
        );
    }

    /**
     * @return array
     */
    public function getDefaultSelect ()
    {
        return array_merge(
            parent::getDefaultSelect(),
            array(
                "PROPERTY_RESERVATIONS_AMOUNT",
                "PROPERTY_ADDRESS",
                "PROPERTY_TIME"
            )
        );
    }
}