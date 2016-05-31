<?php

namespace ObsessionTest\AnswerVariant;

use Application\Base\Bitrix\Model\IBlockElement as BaseIBlockElementModel;

class Model extends BaseIBlockElementModel
{
    const IBLOCK_CODE = "obsessions";

    /**
     * @return string
     */
    public function getIBlockCode()
    {
        return self::IBLOCK_CODE;
    }

    /**
     * @param array $additionalFilter
     * @param null $sort
     * @param int $limit
     * @param int $page
     * @return array
     */
    public function getList($additionalFilter = array(), $sort = null, $limit = 0, $page = 1)
    {
        $answerVariants = parent::getList($additionalFilter, $sort, $limit, $page);
        $grouped = array();
        foreach ($answerVariants as $variant) {
            $variantId = $variant["ID"];
            if (!isset($grouped[$variantId])) {
                $grouped[$variantId] = $variant;
                unset($grouped[$variantId]["OBSESSION"]);
                $grouped[$variantId]["OBSESSION_POINTS"] = array();
            }
            $grouped[$variantId]["OBSESSION_POINTS"][] = $variant["OBSESSION"];
        }
        return $grouped;
    }

    /**
     * @param int $id
     * @return array|null
     */
    public function getOne($id)
    {
        $filter = array("ID" => $id);
        $list = $this->getList($filter);
        return array_shift($list);
    }

    /**
     * @return array
     */
    public function getDefaultSort()
    {
        return array(
            "RAND" => "ASC"
        );
    }

    /**
     * @return array
     */
    public function getDefaultSelect()
    {
        return array_merge(
            parent::getDefaultSelect(),
            array(
                "SECTION_ID",
                "PROPERTY_OBSESSION"
            )
        );
    }

    /**
     * @param array $answerVariant
     * @return array
     */
    public function formatDBResult($answerVariant)
    {
        return array(
            "ID" => $answerVariant["ID"],
            "NAME" => $answerVariant["NAME"],
            "QUESTION_ID" => $answerVariant["SECTION_ID"],
            "OBSESSION" => $answerVariant["PROPERTY_OBSESSION_VALUE"]
        );
    }
}
