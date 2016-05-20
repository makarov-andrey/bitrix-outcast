<?php

namespace Preview\Reservation;


use Application\Base\Model as BaseModel;
use Application\Tools;
use CFormResult;

class Model extends BaseModel
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
     * Считает количество записавшихся на предзаказ пользователей
     * в городе $cityId
     *
     * @param int $cityId
     * @return int
     */
    public function countForCity($cityId)
    {
        $CFormResult = new CFormResult();
        $formId = Tools::getWebFormIdByCode(self::FORM_CODE);
        $by = "s_id";
        $order = "asc";
        $filter = array(
            "FIELDS" => array(
                array(
                    "CODE" => self::CITY_QUESTION_CODE,
                    "FILTER_TYPE" => "integer",
                    "PARAMETER_NAME" => "USER",
                    "VALUE" => $cityId,
                    "PART" => 0
                )
            )
        );
        $filtered = false;
        $checkRights = "N";
        $dbResult = $CFormResult->getList($formId, $by, $order, $filter, $filtered, $checkRights);
        $dbResult->NavStart();
        return $dbResult->NavRecordCount;
    }


    /**
     * Возвращает результат web-формы резервации предпоказа по её id
     *
     * @param $id
     * @return array|null
     */
    public function find ($id)
    {
        $CFormResult = new CFormResult();
        $fields = self::getQuestionsCodes();
        $result = $CFormResult->GetDataByID($id, $fields, $null, $null);
        return $result ? self::formatDataByIdDBResult($result) : null;
    }

    /**
     * Возвращает результат web-формы резервации предпоказа для текущего
     * пользователя
     *
     * @return array|null
     */
    public function findForCurrentUser ()
    {
        if (!self::isUserBlocked()) {
            return null;
        }
        $reservationId = self::getUserReservationId();
        return $this->find($reservationId);
    }

    /**
     * создает массив из пар значений "код поля" => "значение" из массива,
     * форматированного как результат выполнения метода CFormResult::GetDataByID()
     *
     * @param $result
     * @return array
     */
    public static function formatDataByIdDBResult ($result)
    {
        $formattedResult = array();
        foreach ($result as $code => $field) {
            $answer = array_shift($field);
            $formattedResult[$code] = $answer["USER_TEXT"];
        }
        return $formattedResult;
    }

    /**
     * Вовзращает массив из мнемоник полей для web-формы резервации предпоказа.
     * Может пригодиться для метода CFormResult::GetDataByID()
     *
     * @return array
     */
    public static function getQuestionsCodes ()
    {
        return array(
            self::CITY_QUESTION_CODE,
            self::FIO_QUESTION_CODE,
            self::PHONE_QUESTION_CODE,
            self::EMAIL_QUESTION_CODE
        );
    }

    /**
     * Блокирует текущему пользователю возможность резервировать место
     * на предпоказ
     *
     * @param int $id - id результата web-формы в БД
     */
    public static function blockCurrentUser ($id)
    {
        setcookie(self::COOKIE_RESERVATION_KEY, $id, time() + self::COOKIE_BLOCK_EXPIRE);
    }

    /**
     * Проверяет может ли текущий пользователь резервировать место
     * на предпоказ
     *
     * @return bool
     */
    public static function isUserBlocked ()
    {
        return isset($_COOKIE[self::COOKIE_RESERVATION_KEY]);
    }

    /**
     * Возвращает id результата web-формы, в которой хранится резервация
     * места на предпоказе
     *
     * @return int|null
     */
    public static function getUserReservationId ()
    {
        return $_COOKIE[self::COOKIE_RESERVATION_KEY];
    }

    /**
     * Блокирует пользователю возможность резервировать место на предпоказ
     *
     * @param int $webFormId
     * @param int $resultId
     */
    public static function blockUserAfterSave ($webFormId, $resultId)
    {
        $webFormCode = Tools::getWebFormCodeById($webFormId);
        if ($webFormCode == self::FORM_CODE) {
            self::blockCurrentUser($resultId);
        }
    }
}