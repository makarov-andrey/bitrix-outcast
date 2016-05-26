<?php

namespace BitrixHelper\API;


use Application\Tools;
use CIBlock;
use Exception;

class IBlock
{
    /**
     * Достает id инфоблока по его коду
     *
     * @param string $code
     * @return int|null
     * @throws Exception
     */
    public static function getIdByCode($code)
    {
        Tools::assertCodeNotEmpty($code);
        Tools::includeModules("iblock");
        $CIBlock = new CIBlock;
        $filter = array("CODE" => $code);
        $result = $CIBlock->GetList(array(), $filter);
        $result->NavStart(1);
        $IBlock = $result->Fetch();
        return $IBlock ? $IBlock["ID"] : null;
    }
}