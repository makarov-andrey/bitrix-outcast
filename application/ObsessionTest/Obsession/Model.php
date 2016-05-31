<?php

namespace ObsessionTest\Obsession;

use Application\Base\Bitrix\Model\IBlockElement as BaseIBlockElementModel;
use User\Model as UserModel;

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

    /**
     * Возвращает текущий результат пользователя
     *
     * @return array|null
     */
    public function getCurrentUserResult ()
    {
        $id = $this->getCurrentUserResultId();
        return is_null($id) ? null : $this->getOne($id);
    }

    /**
     * Возвращает id текущего результата пользователя
     *
     * @return int|null
     */
    public function getCurrentUserResultId ()
    {
        $userId = UserModel::getCurrentUserId();
        return is_null($userId) ? null : $this->getUserResultId($userId);
    }

    /**
     * Достает id результата пользователя
     *
     * @param int $userId
     * @return int|null
     */
    public function getUserResultId ($userId)
    {
        global $USER;
        $by = "id";
        $order = "asc";
        $filter = array(
            "ID" => $userId
        );
        $select = array(
            "SELECT" => array("UF_OBSESSION")
        );
        $dbResult = $USER->GetList($by, $order, $filter, $select);
        $dbResult->NavStart(1);
        $user = $dbResult->Fetch();
        return $user ? $user["UF_OBSESSION"] : null;
    }

    /**
     * Сохраняет id результата пользователя
     *
     * @param int $userId
     * @param int $resultId
     * @return void
     */
    public function setUserResult ($userId, $resultId)
    {
        global $USER;
        $fields = array(
            "UF_OBSESSION" => $resultId
        );
        $USER->Update($userId, $fields);
    }

    /**
     * Сохраняет id результата текущего пользователя
     *
     * @param int $resultId
     * @return void
     */
    public function setCurrentUserResult ($resultId)
    {
        UserModel::assertUserAuthorized();
        $userId = UserModel::getCurrentUserId();
        $this->setUserResult($userId, $resultId);
    }

    /**
     * Проверяет имеет ли текущий пользователь результат теста
     *
     * @return bool
     */
    public function currentUserHasResult () {
        $userId = UserModel::getCurrentUserId();
        return !is_null($userId) && $this->userHasResult($userId);
    }

    /**
     * Проверяет имеет ли пользователь результат теста
     *
     * @param int $userId
     * @return bool
     */
    public function userHasResult ($userId) {
        $resultId = $this->getUserResultId($userId);
        return !is_null($resultId);
    }
}
