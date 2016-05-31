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

    /**
     * Возвращает массив вопросов, включая варианты ответа
     *
     * @param array $additionalFilter
     * @param array|null $sort
     * @param int $limit
     * @param int $page
     * @return array
     */
    public function getList ($additionalFilter = array(), $sort = null, $limit = 0, $page = 1)
    {
        $questions = parent::getList($additionalFilter, $sort, $limit, $page);
        if (empty($questions)) {
            return array();
        }
        $questionsIds = $this->collectIds($questions);
        $answerVariantModel = new AnswerVariantModel();
        $filter = array("SECTION_ID" => $questionsIds);
        $answerVariants = $answerVariantModel->getList($filter);
        $this->spreadAnswerVariantDataToQuestions($questions, $answerVariants);
        return $questions;
    }

    /**
     * Проставляет соответствия вопросов и их вариантов ответов для массива вопросов
     * 
     * @param array &$questions
     * @param array $answerVariants
     */
    public function spreadAnswerVariantDataToQuestions (&$questions, $answerVariants)
    {
        $answerVariantsByQuestion = array();
        foreach($answerVariants as $variant) {
            $questionId = $variant["QUESTION_ID"];
            if (!isset($answerVariantsByQuestion[$questionId])) {
                $answerVariantsByQuestion[$questionId] = array();
            }
            $variantId = $variant["ID"];
            $answerVariantsByQuestion[$questionId][$variantId] = $variant;
        }
        foreach ($questions as &$question) {
            $questionId = $question["ID"];
            $question["ANSWER_VARIANTS"] = $answerVariantsByQuestion[$questionId];
        }
        unset($question);
    }
}
