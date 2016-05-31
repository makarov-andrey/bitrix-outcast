<?php

namespace Application\Base\Bitrix\Model;

use Application\Tools;
use CIBlockElement;

abstract class IBlockElement extends IBlock
{
    /**
     * Возвращает массив элементов из инфоблока
     *
     * @param array $additionalFilter
     * @param array $sort
     * @param int $limit
     * @param int $page
     * @return array
     */
    public function getList($additionalFilter = array(), $sort = null, $limit = 1000000, $page = 1)
    {
        if (is_null($sort)) {
            $sort = $this->getDefaultSort();
        }

        $filter = $this->getDefaultFilter();
        $filter = array_merge($filter, $additionalFilter);

        $select = $this->getDefaultSelect();

        $CIBlockElement = new CIBlockElement();
        $dbResult = $CIBlockElement->GetList($sort, $filter, false, false, $select);
        $dbResult->NavStart($limit, true, $page);

        $elements = array();
        while ($element = $dbResult->Fetch()) {
            $elements[] = $this->formatDBResult($element);
        }
        return $elements;
    }

    /**
     * достает запись из БД по id
     *
     * @param int $id
     * @return null
     */
    public function getOne($id)
    {
        Tools::assertValidId($id);

        $filter = $this->getDefaultFilter();
        $filter["ID"] = $id;

        $select = $this->getDefaultSelect();

        $CIBlockElement = new CIBlockElement();
        $dbResult = $CIBlockElement->GetList(array(), $filter, false, false, $select);
        $dbResult->NavStart(1);

        $element = $dbResult->Fetch();
        return $element ? $this->formatDBResult($element) : null;
    }

    /**
     * Метод для форматирования результата выборки из базы данных. Предназначен
     * для назначения данным более понятных в предметной области алиасов. Для
     * использования должен перезаписываться в моделях-потомках.
     *
     * @param $section
     * @return array
     */
    public function formatDBResult($section)
    {
        return $section;
    }
}