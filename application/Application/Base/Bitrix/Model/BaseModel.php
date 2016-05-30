<?php

namespace Application\Base\Bitrix\Model;


use Application\Tools;

abstract class BaseModel
{
    /**
     * Зависимые для модели bitrix модули
     *
     * @var string[]
     */
    private $dependencies = array();

    /**
     * Конструктор подключает зависимости, необходимые для работы модели.
     */
    public function __construct()
    {
        $this->declareDependencies();
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

    /**
     * Метод добавляет зависимости модели для их будущего подключения
     * @param string|string[] $dependencies
     */
    final protected function addDependencies ($dependencies) {
        Tools::wrapArrayIfNotItIs($dependencies);
        $this->dependencies = array_merge(
            $this->dependencies,
            $dependencies
        );
    }

    /**
     * Этот метод следует перезаписывать в тех потомках этого класса,
     * работа которых зависит от некоторых модулей битрикса. В нем следует
     * вызывать метод addDependencies()
     */
    protected function declareDependencies () {

    }
}
