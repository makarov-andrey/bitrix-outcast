<?php

namespace Application\Base\Bitrix\Component;


use Application\Base\Bitrix\WebForm;

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
            "WEB_FORM_ID" => WebForm::getIdByCode($webFormCode),
            "LIST_URL" => "",
            "EDIT_URL" => "",
            "SUCCESS_URL" => "",
            "IGNORE_CUSTOM_TEMPLATE" => "N",
            "USE_EXTENDED_ERRORS" => "Y",
            "CACHE_TYPE" => "A"
        );
    }
}