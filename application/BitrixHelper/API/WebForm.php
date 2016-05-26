<?php

namespace BitrixHelper\API;

use Application\Tools;
use CForm;
use CFormField;
use Exception;

class WebForm
{
    /**
     * Возвращает id веб-формы по её коду
     *
     * @param string $code
     * @return int|null
     */
    public static function getIdByCode($code)
    {
        Tools::assertCodeNotEmpty($code);
        Tools::includeModules("form");
        $CForm = new CForm();
        $rsForm = $CForm->GetBySID($code);
        $rsForm->NavStart(1);
        $arForm = $rsForm->Fetch();
        return $arForm ? $arForm["ID"] : null;
    }

    /**
     * Возвращаеь код веб-формы по её id
     *
     * @param $id
     * @return null
     * @throws Exception
     */
    public static function getCodeById($id)
    {
        Tools::assertValidId($id);
        Tools::includeModules("form");
        $CForm = new CForm();
        $rsForm = $CForm->GetByID($id);
        $rsForm->NavStart(1);
        $arForm = $rsForm->Fetch();
        return $arForm ? $arForm["SID"] : null;
    }

    /**
     * Возвращает id вопроса веб-формы по его коду
     *
     * @param string $code
     * @return int|null
     * @throws Exception
     */
    public static function getQuestionIdByCode($code)
    {
        Tools::assertCodeNotEmpty($code);
        Tools::includeModules("form");
        $CFormField = new CFormField();
        $dbResult = $CFormField->GetBySID($code);
        $dbResult->NavStart(1);
        $result = $dbResult->Fetch();
        return $result ? $result["ID"] : null;
    }
}