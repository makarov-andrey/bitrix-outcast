<?php

namespace Application;

use Bitrix\Highloadblock\HighloadBlockTable;
use CIBlock;
use CModule;
use Exception;
use InvalidArgumentException;

class Tools
{
    /**
     * Если параметр не массив, то оборачивает его массивом. Параметр
     * изменяется по ссылке и возвращается.
     *
     * @param mixed &$var
     * @return array($var)
     */
    public static function wrapArrayIfNotItIs(&$var) {
        if (!is_array($var)) {
            $var = array($var);
        }
        return $var;
    }

    /**
     * Пытается подключить модули bitrix, выбрасывает исключение Exception,
     * если модуль подключить не удалось.
     *
     * @param string|string[] $modules
     * @throws Exception
     */
    public static function includeModules ($modules)
    {
        self::wrapArrayIfNotItIs($modules);
        foreach ($modules as $module) {
            $result = CModule::IncludeModule($module);
            if (!$result) {
                throw new Exception ("Can't include module \"$module\"");
            }
        }
    }

    /**
     * Достает массив с данными highload инфоблока по его коду
     *
     * @param string $code
     * @return array|null
     * @throws Exception
     * @throws \Bitrix\Main\ArgumentException
     */
    public static function getHLBlockByCode ($code)
    {
        self::assertCodeNotEmpty($code);
        self::includeModules("highloadblock");
        $filter = array("NAME" => $code);
        $params = array(
            "filter" => $filter,
            "limit" => 1
        );
        $highLoadBlock = HighloadBlockTable::getList($params)->fetch();
        return $highLoadBlock ?: null;
    }

    /**
     * Достает id инфоблока по его коду
     *
     * @param string $code
     * @return int|null
     * @throws Exception
     */
    public static function getIBlockIdByCode ($code)
    {
        self::assertCodeNotEmpty($code);
        self::includeModules("iblock");
        $CIBlock = new CIBlock;
        $filter = array("CODE" => $code);
        $result = $CIBlock->GetList(array(), $filter);
        $result->NavStart(1);
        $IBlock = $result->Fetch();
        return $IBlock["ID"] ?: null;
    }

    /**
     * Проверяет точно ли $code не пустой
     *
     * @param mixed $code
     */
    protected static function assertCodeNotEmpty ($code)
    {
        if (empty($code)) {
            throw new InvalidArgumentException("Парамет code не может быть пустым");
        }
    }

    /**
     * Возвращает стандартный набор параметров для вызова компонента
     * bitrix:news.list
     *
     * @param $IBlockType
     * @param $IBlockCode
     * @return array
     */
    public static function getDefaultNewsListComponentParams ($IBlockType, $IBlockCode)
    {
        return array(
            "IBLOCK_TYPE" => $IBlockType,
            "IBLOCK_ID" => self::getIBlockIdByCode($IBlockCode),
            "AJAX_MODE" => "N",
            "NEWS_COUNT" => 20,
            "SORT_BY1" => "SORT",
            "SORT_ORDER1" => "ASC",
            "SORT_BY2" => "ID",
            "SORT_ORDER2" => "DESC",
            "FILTER_NAME" => "",
            "FIELD_CODE" => Array(),
            "PROPERTY_CODE" => Array(),
            "CHECK_DATES" => "N",
            "ACTIVE_DATE_FORMAT" => "j F",
            "SET_TITLE" => "N",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "ADD_SECTIONS_CHAIN" => "N",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "INCLUDE_SUBSECTIONS" => "Y",
            "CACHE_TYPE" => "A",
            "DISPLAY_BOTTOM_PAGER" => "Y",
            "PAGER_TITLE" => "",
            "PAGER_SHOW_ALWAYS" => "Y",
            "PAGER_TEMPLATE" => "",
            "PAGER_DESC_NUMBERING" => "N",
        );
    }
}
