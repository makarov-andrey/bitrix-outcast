<?php

namespace ObsessionTest\Question;

use Application\Base\Bitrix\Model\IBlockSection as BaseIBlockSectionModel;
use ObsessionTest\AnswerVariant\Model as AnswerVariantModel;

class Model extends BaseIBlockSectionModel
{
    const IBLOCK_CODE = "obsession_test_questions";

    /**
     * @return string
     */
    public function getIBlockCode()
    {
        return self::IBLOCK_CODE;
    }

    /**
     * Возвращает массив с данными вопроса, включая варианты ответа
     *
     * @param int $id
     * @return array|null
     */
    public function getOne ($id)
    {
        $question = parent::getOne($id);
        if (is_null($question)) {
            return null;
        }
        $answerVariantModel = new AnswerVariantModel();
        $filter = array("SECTION_ID" => $id);
        $question["ANSWER_VARIANTS"] = $answerVariantModel->getList($filter);
        return $question;
    }
}
