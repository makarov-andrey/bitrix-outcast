<?php

namespace Application\Base\Bitrix\Model;

use Application\Base\Bitrix\Model\Interfaces\WebForm as WebFormInterface;
use BitrixHelper\API\WebForm as WebFormHelper;

abstract class WebForm
    extends BaseModel
    implements WebFormInterface
{
    public function declareDependencies()
    {
        parent::declareDependencies();
        $this->addDependencies("form");
    }

    /**
     * Возвращает id инфоблока текущей модели
     *
     * @return int|null
     */
    public function getWebFormId () {
        $code = $this->getWebFormCode();
        return WebFormHelper::getIdByCode($code);
    }
}