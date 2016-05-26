<?php

namespace Preview\Reservation;


use Application\Base\Bitrix\Model\WebFormResult as BaseWebFormResultModel;
use BitrixHelper\API\WebForm as WebFormHelper;

class Model extends BaseWebFormResultModel
{
    protected $dependencies = array("form");

    const COOKIE_RESERVATION_KEY = "preview_reservation_id";
    const COOKIE_BLOCK_EXPIRE = 31536000; //365 дней

    const FORM_CODE = "preview";

    const CITY_QUESTION_CODE = "city";
    const FIO_QUESTION_CODE = "fio";
    const PHONE_QUESTION_CODE = "phone";
    const EMAIL_QUESTION_CODE = "email";

    /**
     * @return string
     */
    public function getWebFormCode()
    {
        return static::FORM_CODE;
    }

    /**
     * @return string[]
     */
    public function getQuestionsCodes ()
    {
        return array(
            static::CITY_QUESTION_CODE,
            static::FIO_QUESTION_CODE,
            static::PHONE_QUESTION_CODE,
            static::EMAIL_QUESTION_CODE
        );
    }

    /**
     * Считает количество записавшихся на предзаказ пользователей
     * в городе $cityId
     *
     * @param int $cityId
     * @return int
     */
    public function countForCity($cityId)
    {
        $filter = array(
            "FIELDS" => array(
                array(
                    "CODE" => static::CITY_QUESTION_CODE,
                    "FILTER_TYPE" => "integer",
                    "PARAMETER_NAME" => "USER",
                    "VALUE" => $cityId,
                    "PART" => 0
                )
            )
        );
        return $this->count($filter);
    }

    /**
     * Возвращает результат web-формы резервации предпоказа для текущего
     * пользователя
     *
     * @return array|null
     */
    public function findOfCurrentUser ()
    {
        if (!$this->isUserBlocked()) {
            return null;
        }
        $reservationId = $this->getUserReservationId();
        return $this->getOne($reservationId);
    }

    /**
     * Блокирует текущему пользователю возможность резервировать место
     * на предпоказ
     *
     * @param int $id - id результата web-формы в БД
     */
    public static function blockCurrentUser ($id)
    {
        setcookie(static::COOKIE_RESERVATION_KEY, $id, time() + static::COOKIE_BLOCK_EXPIRE);
    }

    /**
     * Проверяет может ли текущий пользователь резервировать место
     * на предпоказ
     *
     * @return bool
     */
    public static function isUserBlocked ()
    {
        return isset($_COOKIE[static::COOKIE_RESERVATION_KEY]);
    }

    /**
     * Возвращает id результата web-формы, в которой хранится резервация
     * места на предпоказе
     *
     * @return int|null
     */
    public static function getUserReservationId ()
    {
        return $_COOKIE[static::COOKIE_RESERVATION_KEY];
    }

    /**
     * Блокирует пользователю возможность резервировать место на предпоказ
     *
     * @param int $webFormId
     * @param int $resultId
     */
    public static function blockUserAfterSave ($webFormId, $resultId)
    {
        $webFormCode = WebFormHelper::getCodeById($webFormId);
        if ($webFormCode == static::getWebFormCode()) {
            static::blockCurrentUser($resultId);
        }
    }
}