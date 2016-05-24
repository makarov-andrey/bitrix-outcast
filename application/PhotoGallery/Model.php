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
    const LIKES_AMOUNT_PROPERTY_CODE = "LIKES_AMOUNT";

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
        return $userId > 0 && $this->isUserLiked($photoId, $userId);
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
        $this->assertUserNotLiked($photoId, $userId);
        $this->addLike($photoId, $userId);
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
        $likedUsers = $this->getUsersWhoLikesThePhoto($photoId);
        $likedUsers[] = $userId;
        $this->saveLikes($photoId, $likedUsers);
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
        $likedUsers = $this->getUsersWhoLikesThePhoto($photoId);
        $key = array_search($userId, $likedUsers);
        if ($key === false) {
            return;
        }
        unset($likedUsers[$key]);
        $this->saveLikes($photoId, $likedUsers);
    }

    /**
     * Сохраняет информацию о лайках для фотографии. В том числе актуализирует
     * поле количества лайков
     *
     * @param int $photoId
     * @param int[] $likes
     */
    protected function saveLikes ($photoId, $likes) {
        $iBlockId = self::getIBlockID();
        $likesAmount = count($likes);
        if (empty($likes)) {
            /*
             * Если фотку лайкал только один пользователь, которого мы сейчас удаляем,
             * то массив $likedUsers станет пустым. Если в ебучий битрикс передать
             * пустой массив, то он не станет ставить множественное поле пустым. Для
             * этого ему нужно передать false.
             */
            $likes = false;
        }
        $values = array(
            self::LIKED_USERS_PROPERTY_CODE => $likes,
            /*
             * Т.к. в битриксе невозможно сортировать выборку элементов инфоблока по
             * количеству значений в множественном поле (в данном случае - поле с лайками
             * пользователей), а сортировка по лайкам необходима по ТЗ, то приходится
             * всегда поддерживать поле количества лайков актуальным, чтобы можно было
             * по нему отсортировать.
             */
            self::LIKES_AMOUNT_PROPERTY_CODE => $likesAmount
        );
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
        if ($this->isUserLiked($photoId, $userId)) {
            $this->removeLike($photoId, $userId);
        } else {
            $this->addLike($photoId, $userId);
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
        $this->toggleLike($photoId, $userId);
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
        $users = $this->getUsersWhoLikesThePhoto($photoId);
        return count($users);
    }

    /**
     * Проверяет точно ли пользователь еще не лайкал фотографию
     *
     * @param int $photoId
     * @param int $userId
     */
    public function assertUserNotLiked ($photoId, $userId)
    {
        if ($this->isUserLiked($photoId, $userId)) {
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