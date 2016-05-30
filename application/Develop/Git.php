<?php

namespace Develop;


use LogicException;

class Git
{
    const REMOTE_REPOSITORY = "origin";

    /**
     * Возвращает путь к папке, где лежит git-репозиторий
     *
     * @return string
     * @throws LogicException
     */
    public static function getDirectoryPath ()
    {
        return CommandLine::execute("git rev-parse --show-toplevel");
    }

    /**
     * Возвращает название текущей ветки
     *
     * @return string
     * @throws LogicException
     */
    public static function getCurrentBrunch ()
    {
        $symbolicRef = CommandLine::execute("git symbolic-ref HEAD");
        return basename($symbolicRef);
    }

    /**
     * Стягивает изменения с репозитория по текущей ветке
     *
     * @return string
     * @throws LogicException
     */
    public static function pull ()
    {
        $branch = static::getCurrentBrunch();
        $repository = static::REMOTE_REPOSITORY;
        return CommandLine::execute("git pull $repository $branch");
    }

    /**
     * Ставит текущее состояние рабочей копии в состояние одноименной ветки на
     * удаленном репозитории.
     * Будьте осторожны! Метод удаляет все локальные изменения, а так же оставляет
     * без ссылок коммиты, которые есть в текущей локальной ветке, но которых нет
     * в ветке удаленного репозитория.
     *
     * @return void
     * @throws LogicException
     */
    public static function forcePull ()
    {
        $branch = static::getCurrentBrunch();
        $repository = static::REMOTE_REPOSITORY;
        CommandLine::execute("git fetch --all");
        CommandLine::execute("git reset --hard $repository/$branch");
    }

    /**
     * Проверяет запущен ли сейчас какой-нибудь git-процесс
     *
     * @return bool
     */
    public static function isBusy ()
    {
        $path = static::getDirectoryPath();
        return file_exists($path . "/.git/index.lock");
    }
}