<?php

namespace Application;

use CModule;
use Exception;

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
        self::wrapArrayIfNotItIs($modules);
        foreach ($modules as $module) {
            $result = CModule::IncludeModule($module);
            if (!$result) {
                throw new Exception ("Can't include module \"$module\"");
            }
        }
    }
}
