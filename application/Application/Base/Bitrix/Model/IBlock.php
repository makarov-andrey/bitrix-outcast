<?php

namespace Application\Base\Bitrix\Model;


use Application\Base\Bitrix\Model\Interfaces\IBlock as IBlockInterface;
use BitrixHelper\API\IBlock as IBlockHelper;

abstract class IBlock
    extends BaseModel
    implements IBlockInterface
{
    public function declareDependencies()
    {
        parent::declareDependencies();
        $this->addDependencies("iblock");
    }

    /**
     * создает массив из алиасов для значений в свойствах и полях инфоблока
     *
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
     * Возвращает массив для сортировки элементов по умолчанию
     *
     * @return array
     */
    public function getDefaultSort ()
    {
        return array(
            "SORT" => "ASC",
            "ID" => "DESC"
        );
    }

    /**
     * Возвращает массив для фильтрации элементов по умолчанию
     *
     * @return array
     */
    public function getDefaultFilter ()
    {
        return array(
            "IBLOCK_ID" => $this->getIBlockId()
        );
    }

    /**
     * Возвращает массив для выборки полей элементов по умолчанию
     *
     * @return array
     */
    public function getDefaultSelect ()
    {
        return array(
            "ID",
            "NAME"
        );
    }

    /**
     * Возвращает id инфоблока текущей модели
     *
     * @return int|null
     */
    public function getIBlockId () {
        $code = $this->getIBlockCode();
        return IBlockHelper::getIdByCode($code);
    }

    /**
     * Возвращает массив, состоящий из ID переданных строк результата
     * запроса к БД
     *
     * @param array $rows
     * @return int[]
     */
    public function collectIds ($rows)
    {
        $ids = array();
        foreach($rows as $row) {
            $ids[] = $row["ID"];
        }
        return $ids;
    }
}