<?php

namespace BitrixHelper\Component;

use BitrixHelper\API\IBlock as IBlockHelper;

class NewsList
{
    /**
     * Возвращает стандартный набор параметров для вызова компонента
     * bitrix:news.list
     *
     * @param string $IBlockType
     * @param string $IBlockCode
     * @return array
     */
    public static function getDefaultParams($IBlockType, $IBlockCode)
    {
        return array(
            "IBLOCK_TYPE" => $IBlockType,
            "IBLOCK_ID" => IBlockHelper::getIdByCode($IBlockCode),
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