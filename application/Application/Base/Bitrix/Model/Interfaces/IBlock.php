<?php

namespace Application\Base\Bitrix\Model\Interfaces;


interface IBlock
{
    /**
     * Метод должен возвращать код инфоблока, с которым работает модель-потомок
     *
     * @return string
     */
    public function getIBlockCode();
}