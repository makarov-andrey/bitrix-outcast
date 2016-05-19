<?php

namespace Application;

use Bitrix\Highloadblock\HighloadBlockTable;
use CIBlock;
use CForm;
use CFormField;
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
        return $IBlock ? $IBlock["ID"] : null;
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
     * Проверяет точно ли $code не пустой
     *
     * @param mixed $id
     */
    protected static function assertIdValid ($id)
    {
        if (intval($id) <= 0) {
            throw new InvalidArgumentException("Парамет id должен быть больше 0");
        }
    }

    /**
     * Возвращает стандартный набор параметров для вызова компонента
     * bitrix:news.list
     *
     * @param string $IBlockType
     * @param string $IBlockCode
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

    /**
     * Возвращает id веб-формы по её коду
     *
     * @param string $code
     * @return int|null
     */
    public static function getWebFormIdByCode ($code)
    {
        self::assertCodeNotEmpty($code);
        self::includeModules("form");
        $CForm = new CForm();
        $rsForm = $CForm->GetBySID($code);
        $rsForm->NavStart(1);
        $arForm = $rsForm->Fetch();
        return $arForm ? $arForm["ID"] : null;
    }

    public static function getWebFormCodeById ($id)
    {
        self::assertIdValid($id);
        self::includeModules("form");
        $CForm = new CForm();
        $rsForm = $CForm->GetByID($id);
        $rsForm->NavStart(1);
        $arForm = $rsForm->Fetch();
        return $arForm ? $arForm["SID"] : null;
    }

    /**
     * Возвращает стандартный набор параметров для вызова компонента
     * bitrix:form.result.new
     *
     * @param string $webFormCode
     * @return array
     */
    public static function getDefaultWebFormResultNewComponentParams ($webFormCode)
    {
        return array(
            "SEF_MODE" => "N",
            "WEB_FORM_ID" => self::getWebFormIdByCode($webFormCode),
            "LIST_URL" => "",
            "EDIT_URL" => "",
            "SUCCESS_URL" => "",
            "IGNORE_CUSTOM_TEMPLATE" => "N",
            "USE_EXTENDED_ERRORS" => "Y",
            "CACHE_TYPE" => "A"
        );
    }

    /**
     * Возвращает id вопроса веб-формы по его коду
     *
     * @param string $code
     * @return int|null
     * @throws Exception
     */
    public static function getWebFormQuestionIdByCode ($code)
    {
        self::assertCodeNotEmpty($code);
        self::includeModules("form");
        $CFormField = new CFormField();
        $dbResult = $CFormField->GetBySID($code);
        $dbResult->NavStart(1);
        $result = $dbResult->Fetch();
        return $result ? $result["ID"] : null;
    }
}
