<?php

namespace Application\Base\Bitrix;


use Application\Tools;
use CIBlock;
use Exception;

abstract class IBlock
{
    /**
     * Достает id инфоблока по его коду
     *
     * @param string $code
     * @return int|null
     * @throws Exception
     */
    public static function getIdByCode($code)
    {
        Tools::assertCodeNotEmpty($code);
        Tools::includeModules("iblock");
        $CIBlock = new CIBlock;
        $filter = array("CODE" => $code);
        $result = $CIBlock->GetList(array(), $filter);
        $result->NavStart(1);
        $IBlock = $result->Fetch();
        return $IBlock ? $IBlock["ID"] : null;
    }

    /**
     * Возвращает массив для сортировки элементов по умолчанию
     *
     * @return array
     */
    public static function getDefaultSort ()
    {
        return array(
            "SORT" => "ASC",
            "CREATED" => "DESC"
        );
    }

    /**
     * Возвращает массив для фильтрации элементов по умолчанию
     *
     * @param string $code
     * @return array
     */
    public static function getDefaultFilter ($code)
    {
        return array(
            "IBLOCK_ID" => self::getIdByCode($code)
        );
    }

    /**
     * Возвращает массив для выборки полей элементов по умолчанию
     *
     * @return array
     */
    public static function getDefaultSelect ()
    {
        return array(
            "ID",
            "NAME"
        );
    }
}