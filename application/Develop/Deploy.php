<?php

namespace Develop;


use LogicException;

class Deploy
{
    /**
     * Сколько делать попыток деплоя, если git занят
     * @var int
     */
    public static $tryAmount = 5;

    /**
     * Сколько времени ждать между попытками деплоя
     * @var int
     */
    public static $tryDelay = 10;

    /**
     * Деплой проекта с помощью git. Если git занят другим процессом, то ждет
     * self::$tryDelay секунд и пытается еще раз. Всего пытается деплоить
     * self::$tryAmount раз. Если гит занят слишком долго - выбрасывает LogicException
     *
     * @param bool $force
     * @return void
     * @throws LogicException
     */
    public static function start ($force = false)
    {
        $i = 0;
        while (Git::isBusy()) {
            $i++;
            if ($i >= self::$tryAmount) {
                $delay = $i * self::$tryDelay;
                throw new LogicException("Git is busy for $delay seconds");
            }
            sleep(self::$tryDelay);
        }
        if ($force === true) {
            Git::forcePull();
        } else {
            Git::pull();
        }
    }
}
