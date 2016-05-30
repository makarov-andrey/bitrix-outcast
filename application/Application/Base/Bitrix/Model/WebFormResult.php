<?php

namespace Application\Base\Bitrix\Model;


use Application\Base\Bitrix\Model\Interfaces\WebFormResult as WebFormResultInterface;
use CFormResult;

abstract class WebFormResult
    extends WebForm
    implements WebFormResultInterface
{
    /**
     * Возвращает результат заполнения web-формы по её id
     *
     * @param $id
     * @return array|null
     */
    public function getOne ($id)
    {
        $CFormResult = new CFormResult();
        $fields = $this->getQuestionsCodes();
        $result = $CFormResult->GetDataByID($id, $fields, $null, $null);
        return $result ? $this->formatDBResult($result) : null;
    }

    /**
     * Метод подсчитывает количество сохраненных результатов заполнения веб-формы
     *
     * @param array $filter
     * @return int
     */
    public function count ($filter = array()) {
        $CFormResult = new CFormResult();
        $formId = $this->getWebFormId();
        $by = "s_id";
        $order = "asc";
        $filtered = false;
        $checkRights = "N";
        $dbResult = $CFormResult->getList($formId, $by, $order, $filter, $filtered, $checkRights);
        $dbResult->NavStart();
        return $dbResult->NavRecordCount;
    }

    /**
     * Создает массив из пар значений "код поля" => "значение" из массива,
     * форматированного как результат выполнения метода CFormResult::GetDataByID()
     *
     * @param $result
     * @return array
     */
    public function formatDBResult ($result)
    {
        $formattedResult = array();
        foreach ($result as $code => $field) {
            $answer = array_shift($field);
            $formattedResult[$code] = $answer["USER_TEXT"];
        }
        return $formattedResult;
    }
}