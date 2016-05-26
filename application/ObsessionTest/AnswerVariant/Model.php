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
}
