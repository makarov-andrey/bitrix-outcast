<?php

namespace Application\Base\Bitrix\Model;

use Application\Tools;
use CIBlockSection;

abstract class IBlockSection extends IBlock
{
    /**
     * Возвращает список всех элементов из инфоблока
     *
     * @return array
     */
    public function getAll ()
    {
        $sort = $this->getDefaultSort();
        $filter = $this->getDefaultFilter();
        $select = $this->getDefaultSelect();

        $CIBlockElement = new CIBlockSection();
        $dbResult = $CIBlockElement->GetList($sort, $filter, false, $select);

        $sections = array();
        while ($section = $dbResult->Fetch()) {
            $sections[] = $this->formatDBResult($section);
        }
        return $sections;
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