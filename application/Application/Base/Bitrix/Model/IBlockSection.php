<?php

namespace Application\Base\Bitrix\Model;

use Application\Tools;
use CIBlockSection;

abstract class IBlockSection extends IBlock
{
    /**
     * Возвращает массив секций из инфоблока
     *
     * @param array $additionalFilter
     * @param array|null $sort
     * @param int $limit
     * @param int $page
     * @return array
     */
    public function getList($additionalFilter = array(), $sort = null, $limit = 0, $page = 1)
    {
        if (is_null($sort)) {
            $sort = $this->getDefaultSort();
        }

        $filter = $this->getDefaultFilter();
        $filter = array_merge($filter, $additionalFilter);

        $select = $this->getDefaultSelect();

        $CIBlockElement = new CIBlockSection();
        $dbResult = $CIBlockElement->GetList($sort, $filter, false, $select);
        $dbResult->NavStart($limit, true, $page);

        $elements = array();
        while ($element = $dbResult->Fetch()) {
            $elements[] = $this->formatDBResult($element);
        }
        return $elements;
    }

    /**
     * Возвращает информацию о  по его id
     *
     * @param int $id
     * @return array|null
     */
    public function getOne ($id)
    {
        Tools::assertValidId($id);

        $filter = $this->getDefaultFilter();
        $filter["ID"] = $id;

        $select = $this->getDefaultSelect();

        $CIBlockSection = new CIBlockSection();
        $dbResult = $CIBlockSection->GetList(array(), $filter, false, $select);
        $dbResult->NavStart(1);

        $section = $dbResult->Fetch();
        return $section ? $this->formatDBResult($section) : null;
    }

    /**
     * Метод для форматирования результата выборки из базы данных. Предназначен
     * для назначения данным более понятных в предметной области алиасов. Для
     * использования должен перезаписываться в моделях-потомках.
     *
     * @param $section
     * @return array
     */
    public function formatDBResult ($section) {
        return $section;
    }
}