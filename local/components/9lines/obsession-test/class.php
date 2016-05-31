<?php

use Application\Tools;
use ObsessionTest\Question\Model as QuestionModel;
use ObsessionTest\Obsession\Model as ObsessionModel;
use ObsessionTest\AnswerVariant\Model as AnswerVariantModel;

class ObsessionTestController extends CBitrixComponent
{
    /**
     * @var QuestionModel
     */
    private $questionModel;

    /**
     * @var ObsessionModel
     */
    private $obsessionModel;

    /**
     * @var AnswerVariantModel
     */
    private $answerVariantModel;

    /**
     * Массив вопросов с вариантами ответов
     *
     * @var array
     */
    private $questions;

    /**
     * Массив данных о результате прохождения теста (одержимость)
     * 
     * @var array
     */
    private $obsession;

    /**
     * Показатель прохождения теста
     * 
     * @var bool
     */
    private $completed = false;

    /**
     * ObsessionTestController constructor.
     *
     * @param CBitrixComponent|null $component
     */
    public function __construct($component)
    {
        $this->questionModel = new QuestionModel();
        $this->obsessionModel = new ObsessionModel();
        $this->answerVariantModel = new AnswerVariantModel();
        parent::__construct($component);
    }

    /**
     * вызывается битриксом
     */
    public function executeComponent()
    {
        $this->questions = $this->questionModel->getList();
        $this->processPost();
        $this->obsession = $this->obsessionModel->getCurrentUserResult();
        $this->completed = !is_null($this->obsession);
        $this->includeTemplate();
    }

    /**
     * Обрабатывает POST-запрос пользователя
     */
    public function processPost()
    {
        if (!$this->needPostProcessing()) {
            return;
        }
        $obsessionPoints = array();
        foreach ($this->questions as $question) {
            $this->assertValidAnswerInPost($question);
            $answerId = $this->getAnswerIdFromPost($question);
            $answer = $question["ANSWER_VARIANTS"][$answerId];
            foreach ($answer["OBSESSIONS_IDS"] as $obsessionId) {
                if (!isset($obsessionPoints[$obsessionId])) {
                    $obsessionPoints[$obsessionId] = 0;
                }
                $obsessionPoints[$obsessionId]++;
            }
        }
        $maxPoint = max($obsessionPoints);
        $resultObsessionId = array_search($maxPoint, $obsessionPoints);
        $this->obsessionModel->setCurrentUserResult($resultObsessionId);
    }

    /**
     * Проверяет нужна ли обработка post-запроса
     * 
     * @return bool
     */
    public function needPostProcessing () 
    {
        return Tools::isPostRequestMethod()
            && isset($_POST["obsession_test"])
            && !$this->obsessionModel->currentUserHasResult();
    }

    /**
     * Выбрасывает исключение, если в post-запросе не правильный ответ на вопрос
     *
     * @param array $question
     */
    public function assertValidAnswerInPost ($question)
    {
        $this->assertExistQuestionInPost($question);
        $answerId = $this->getAnswerIdFromPost($question);
        $answerIds = $this->answerVariantModel->collectIds($question["ANSWER_VARIANTS"]);
        if (!in_array($answerId, $answerIds)) {
            throw new InvalidArgumentException("Неверный формат ответа на вопрос.");
        }
    }

    /**
     * Выбрасывает исключение, если в post-запросе нет ответа на вопрос 
     * 
     * @param array $question
     */
    public function assertExistQuestionInPost ($question)
    {
        $answerId = $this->getAnswerIdFromPost($question);
        if (is_null($answerId)) {
            throw new InvalidArgumentException("Вы ответили не на все вопросы.");
        }
    }

    /**
     * Возвращает id ответа для вопроса из post-запроса
     *
     * @param array $question
     * @return null
     */
    public function getAnswerIdFromPost ($question) {
        $questionId = $question["ID"];
        return $_POST["answers"][$questionId] ?: null;
    }

    /**
     * Подключает шаблон компонента
     */
    public function includeTemplate()
    {
        if ($this->completed) {
            $this->arResult["OBSESSION"] = $this->obsession;
            $templateName = "result";
        } else {
            $this->arResult["QUESTIONS"] = $this->questions;
            $templateName = "template";
        }
        $this->includeComponentTemplate($templateName);
    }
}
