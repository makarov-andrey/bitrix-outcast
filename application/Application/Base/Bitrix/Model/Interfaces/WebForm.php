<?php

namespace Application\Base\Bitrix\Model\Interfaces;


interface WebForm
{
    /**
     * Метод должен возвращать код веб-формы, с которой работает модель-потомок
     *
     * @return string
     */
    public function getWebFormCode();
}