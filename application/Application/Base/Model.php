<?php

namespace Application\Base;


use Application\Tools;

abstract class Model
{
    /**
     * Зависимые для модели bitrix модули
     *
     * @var string[]
     */
    protected $dependencies = array();

    /**
     * Конструктор подключает зависимости, необходимые для работы модели.
     */
    public function __construct()
    {
        $this->includeDependencies();
    }

    /**
     * Подключает зависимости модели
     * @throws \Exception
     */
    protected function includeDependencies ()
    {
        Tools::includeModules($this->dependencies);
    }
}
