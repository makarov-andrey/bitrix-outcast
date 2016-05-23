<?php

namespace PhotoGallery;


use Application\Base\Bitrix\IBlock;
use Application\Base\Model as BaseModel;
use Application\Tools;
use CIBlockElement;
use InvalidArgumentException;
use User\Model as UserModel;

class Model extends BaseModel
{
    protected $dependencies = array("iblock");

    const IBLOCK_TYPE = "photogallery";
    const IBLOCK_CODE = "photogallery";

    const LIKED_USERS_PROPERTY_CODE = "LIKED_USERS";
    const CITY_PROPERTY_CODE = "CITY";

    /**
     * Вернет true, если пользователь лайкал фотографию раньше
     *
     * @param int $userId
     * @param int $photoId
     * @return bool
     */
    public function isUserLiked ($photoId, $userId)
    {
        Tools::assertValidId($userId);
        Tools::assertValidId($photoId);
        $CIBlockElement = new CIBlockElement();
        $filter = array_merge(
            self::getDefaultFilter(),
            array(
                "ID" => $photoId,
                "PROPERTY_" . self::LIKED_USERS_PROPERTY_CODE => $userId
            )
        );
        $select = IBlock::getDefaultSelect();
        $dbResult = $CIBlockElement->GetList(array(), $filter, false, false, $select);
        $dbResult->NavStart(1);
        $result = $dbResult->fetch();
        return !empty($result);
    }

    /**
     * Вернет true, если текущий пользователь лайкнул фотографию
     *
     * @param int $photoId
     * @return bool
     */
    public function isCurrentUserLiked ($photoId)
    {
        global $USER;
        $userId = intval($USER->GetID());
        return $userId > 0 && self::isUserLiked($photoId, $userId);
    }

    /**
     * Сохраняет лайк от пользователя для фотографии, проверяя точно ли
     * лайк от этого пользователя не был поставлен
     *
     * @param int $photoId
     * @param int $userId
     */
    public function like ($photoId, $userId)
    {
        self::assertUserNotLiked($photoId, $userId);
        self::addLike($photoId, $userId);
    }

    /**
     * Сохраняет лайк от пользователя для фотографии, не делая проверок
     *
     * @param int $photoId
     * @param int $userId
     */
    public function addLike ($photoId, $userId)
    {
        Tools::assertValidId($userId);
        Tools::assertValidId($photoId);
        $iBlockId = self::getIBlockID();
        $likedUsers = self::getUsersWhoLikesThePhoto($photoId);
        $likedUsers[] = $userId;
        $values = array(self::LIKED_USERS_PROPERTY_CODE => $likedUsers);
        CIBlockElement::SetPropertyValuesEx($photoId, $iBlockId, $values);
    }

    /**
     * Удаляет лайк от пользователя для фотографии. Не вернет ошибку, если
     * пользователь не ставил лайк.
     *
     * @param int $photoId
     * @param int $userId
     */
    public function removeLike ($photoId, $userId)
    {
        Tools::assertValidId($userId);
        Tools::assertValidId($photoId);
        $iBlockId = self::getIBlockID();
        $likedUsers = self::getUsersWhoLikesThePhoto($photoId);
        $key = array_search($userId, $likedUsers);
        if ($key === false) {
            return;
        }
        unset($likedUsers[$key]);
        if (empty($likedUsers)) {
            /*
             * Если фотку лайкал только один пользователь, которого мы
             * сейчас удаляем, то массив $likedUsers станет пустым.
             * Если в ебучий битрикс передать пустой массив, то он не
             * станет ставить множественное поле пустым. Для этого ему
             * нужно передать false.
             */
            $likedUsers = false;
        }
        $values = array(self::LIKED_USERS_PROPERTY_CODE => $likedUsers);
        CIBlockElement::SetPropertyValuesEx($photoId, $iBlockId, $values);
    }

    /**
     * Если пользователь лайкнул фото, то удаляет лайк.
     * Иначе - добавляет его
     *
     * @param int $photoId
     * @param int $userId
     */
    public function toggleLike ($photoId, $userId)
    {
        if (self::isUserLiked($photoId, $userId)) {
            self::removeLike($photoId, $userId);
        } else {
            self::addLike($photoId, $userId);
        }
    }

    /**
     * Меняет состояние лайка текущего пользователя для фотографии
     *
     * @param int $photoId
     */
    public function toggleCurrentUserLike ($photoId)
    {
        global $USER;
        UserModel::assertUserAuthorized();
        $userId = $USER->GetID();
        self::toggleLike($photoId, $userId);
    }

    /**
     * Возвращает массив пользователей, которые уже лайкнули фотографию
     *
     * @param int $photoId
     * @return array
     */
    public function getUsersWhoLikesThePhoto ($photoId)
    {
        Tools::assertValidId($photoId);
        $iBlockId = self::getIBlockID();
        $filter = array(
            "CODE" => self::LIKED_USERS_PROPERTY_CODE
        );
        $dbResult = CIBlockElement::GetProperty($iBlockId, $photoId, "sort", "asc", $filter);
        $users = array();
        while($user = $dbResult->Fetch()) {
            $userId = intval($user["VALUE"]);
            if ($userId > 0) {
                $users[] = $user["VALUE"];
            }
        }
        return $users;
    }

    /**
     * Подсчитывает количество лайков для фотографии
     *
     * @param int $photoId
     * @return int
     */
    public function countLikes ($photoId)
    {
        $users = self::getUsersWhoLikesThePhoto($photoId);
        return count($users);
    }

    /**
     * Проверяет точно ли пользователь еще не лайкал фотографию
     *
     * @param int $photoId
     * @param int $userId
     */
    public static function assertUserNotLiked ($photoId, $userId)
    {
        if (self::isUserLiked($photoId, $userId)) {
            throw new InvalidArgumentException("Пользователь уже лайкал эту фотографию");
        }
    }

    /**
     * @return array
     */
    public static function getDefaultFilter ()
    {
       return IBlock::getDefaultFilter(self::IBLOCK_CODE);
    }

    /**
     * @return int|null
     */
    public static function getIBlockID ()
    {
        return IBlock::getIdByCode(self::IBLOCK_CODE);
    }
}