<?php

namespace BitrixHelper\Component;

use BitrixHelper\API\WebForm as WebFormHelper;

class FormResultNew
{
    /**
     * Возвращает стандартный набор параметров для вызова компонента
     * bitrix:form.result.new
     *
     * @param string $webFormCode
     * @return array
     */
    public static function getDefaultParams($webFormCode)
    {
        return array(
            "SEF_MODE" => "N",
            "WEB_FORM_ID" => WebFormHelper::getIdByCode($webFormCode),
            "LIST_URL" => "",
            "EDIT_URL" => "",
            "SUCCESS_URL" => "",
            "IGNORE_CUSTOM_TEMPLATE" => "N",
            "USE_EXTENDED_ERRORS" => "Y",
            "CACHE_TYPE" => "A"
        );
    }
}