<?php

namespace User;

use Application\Tools;
use InvalidArgumentException;
use CUser;
use CFile;

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

    /**
     * Возвращает адрес к фотографии пользователя
     *
     * @param $userId
     * @return string|null
     */
    public static function getAvatarId ($userId) {
        Tools::assertValidId($userId);
        $CUser = new CUser;
        $by = "id";
        $order = "asc";
        $filter = array(
            "ID" => $userId
        );
        $params = array(
            "FIELDS" => "PERSONAL_PHOTO"
        );
        $dbResult = $CUser->GetList($by, $order, $filter, $params);
        $user = $dbResult->Fetch();
        return $user["PERSONAL_PHOTO"] ?: null;
    }


    /**
     * Возвращает адрес к фотографии текущего пользователя
     *
     * @return string|null
     */
    public static function getCurrentUserAvatarId ()
    {
        $userId = self::getCurrentUserId();
        return is_null($userId) ? null : self::getAvatarId($userId);
    }
}