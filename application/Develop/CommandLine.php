<?php

namespace Develop;


use LogicException;

class CommandLine
{
    /**
     * Запускает команду
     *
     * @param string $command
     * @param &$response - буфер вывода
     * @param &$code - буфер кода ответа
     */
    public static function run ($command, &$response = null, &$code = null)
    {
        exec($command . " 2>&1", $response, $code);
        $response = implode("\n", $response);
    }

    /**
     * Запускает команду и проверяет код ответа
     *
     * @param string $command
     * @return string - результат выполнения команды
     * @throws LogicException
     */
    public static function execute ($command)
    {
        static::run($command, $response, $code);
        if ($code != 0) {
            throw new LogicException($response, $code);
        }
        return $response;
    }
}