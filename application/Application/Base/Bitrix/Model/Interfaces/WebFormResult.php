<?php

namespace Application\Base\Bitrix\Model\Interfaces;


interface WebFormResult
{
    /**
     * Метод должен возвращать массив из кодов вопросов вебформы
     *
     * @return string[]
     */
    public function getQuestionsCodes ();
}