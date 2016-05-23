<?php

namespace PhotoGallery;


use Application\Base\Bitrix\IBlock;
use Application\Base\Model as BaseModel;
use Application\Tools;
use CIBlockElement;
use InvalidArgumentException;

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
        $result = $dbResult->fetch();
        return !empty($result);
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
        self::saveLike($photoId, $userId);
    }

    /**
     * Сохраняет лайк от пользователя для фотографии, не делая проверок
     *
     * @param int $photoId
     * @param int $userId
     */
    protected function saveLike ($photoId, $userId)
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
     * Достает пользователей, которые уже лайкнули фотографию
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
        $rsResult = CIBlockElement::GetProperty($iBlockId, $photoId, array(), $filter);
        $users = array();
        while($like = $rsResult->Fetch()) {
            $users[] = $like["VALUE"];
        }
        return $users;
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