<?php

namespace User;

use InvalidArgumentException;

class Model
{
    /**
     * Выбрасывает исключение, если пользователь не авторизован
     */
    public static function assertUserAuthorized()
    {
        global $USER;
        if (!$USER->IsAuthorized()) {
            throw new InvalidArgumentException("Пользователь не авторизован");
        }
    }

    /**
     * Возвращает id текущего пользователя
     * 
     * @return int|null
     */
    public static function getCurrentUserId ()
    {
        global $USER;
        if (!$USER->IsAuthorized()) {
            return null;
        }
    	return $USER->GetID();
    }
}