<?php
/**
 * Автоподгрузка классов приложения по стандартам PSR-4
 * http://www.php-fig.org/psr/psr-4/
 */

$nameSpacePrefix = "";
$baseDirectory = __DIR__;

spl_autoload_register(function($className) use ($nameSpacePrefix, $baseDirectory) {
    $nameSpacePrefix = preg_replace("/^\\\\+/", "", $nameSpacePrefix);
    $nameSpacePrefix = str_replace("\\", "\\\\", $nameSpacePrefix);

    if (!preg_match("/^$nameSpacePrefix/", $className)) {
        return;
    }

    $className = preg_replace("/^$nameSpacePrefix/", "", $className);
    $className = str_replace("\\", "/", $className);

    $filename = $baseDirectory . "/" . $className . ".php";
    if (file_exists($filename)) {
        include $filename;
    }
});