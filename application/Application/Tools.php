<?php

namespace Application;

use CModule;
use Exception;
use InvalidArgumentException;

class Tools
{
    /**
     * Если параметр не массив, то оборачивает его массивом. Параметр
     * изменяется по ссылке и возвращается.
     *
     * @param mixed &$var
     * @return array($var)
     */
    public static function wrapArrayIfNotItIs(&$var) {
        if (!is_array($var)) {
            $var = array($var);
        }
        return $var;
    }

    /**
     * Пытается подключить модули bitrix, выбрасывает исключение Exception,
     * если модуль подключить не удалось.
     *
     * @param string|string[] $modules
     * @throws Exception
     */
    public static function includeModules ($modules)
    {
        static::wrapArrayIfNotItIs($modules);
        foreach ($modules as $module) {
            $result = CModule::IncludeModule($module);
            if (!$result) {
                throw new Exception ("Can't include module \"$module\"");
            }
        }
    }


    /**
     * Проверяет точно ли $code не пустой
     *
     * @param mixed $code
     */
    public static function assertCodeNotEmpty ($code)
    {
        if (empty($code)) {
            throw new InvalidArgumentException("Парамет code не может быть пустым");
        }
    }

    /**
     * Проверяет точно ли $id не пустой
     *
     * @param mixed $id
     */
    public static function assertValidId ($id)
    {
        if (intval($id) <= 0) {
            throw new InvalidArgumentException("Параметр id должен быть больше 0");
        }
    }

    /**
     * Проверяет является ли метод запроса POST
     *
     * @return bool
     */
    public static function isPostRequestMethod ()
    {
        return $_SERVER["REQUEST_METHOD"] == "post";
    }
}
