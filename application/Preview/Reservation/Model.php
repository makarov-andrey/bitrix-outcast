<?php

namespace Preview\Reservation;


use Application\Base\Model as BaseModel;
use Application\Tools;
use CFormResult;

class Model extends BaseModel
{
    protected $dependencies = array("form");

    const FORM_CODE = "preview";
    const CITY_QUESTION_CODE = "city";
    const COOKIE_BLOCK_KEY = "block_reservation";
    const COOKIE_BLOCK_EXPIRE = 86400 * 365;

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
            ),
            "STATUS_ID" => 1
        );
        $filtered = false;
        $checkRights = "N";
        $dbResult = $CFormResult->getList($formId, $by, $order, $filter, $filtered, $checkRights);
        $dbResult->NavStart();
        return $dbResult->NavRecordCount;
    }

    /**
     * Блокирует текущему пользователю возможность резервировать место
     * на предпоказ
     */
    public static function blockCurrentUser ()
    {
        setcookie(self::COOKIE_BLOCK_KEY, "Y", time() + self::COOKIE_BLOCK_EXPIRE);
    }

    /**
     * Проверяет может ли текущий пользователь резервировать место
     * на предпоказ
     *
     * @return bool
     */
    public static function isUserBlocked ()
    {
        return isset($_COOKIE[self::COOKIE_BLOCK_KEY]);
    }

    public static function blockUserAfterSave ($webFormId)
    {
        $webFormCode = Tools::getWebFormCodeById($webFormId);
        if ($webFormCode == self::FORM_CODE) {
            self::blockCurrentUser();
        }
    }
}