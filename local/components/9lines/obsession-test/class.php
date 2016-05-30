<?php

use Application\Tools;

class ObsessionTestController extends CBitrixComponent
{
    /**
     * Стартовое состояние, когда пользователь еще не начал отвечать на вопросы и
     * ему показывается страница с кнопкой старта.
     */
    const START_STATE = 100;

    /**
     * Состояние прохождения теста. Пользователь начал проходить тест, но ответил
     * еще не на все вопросы. Ему нужно показать его текущий вопрос.
     */
    const QUESTION_STATE = 200;

    /**
     * Состояние результата теста. Пользователь закончил прохождение теста и ему
     * нужно показать его результат.
     */
    const RESULT_STATE = 300;

    /**
     * Показатель текущего состояния теста.
     *
     * @var int
     */
    private $state;

    /**
     * вызывается битриксом
     */
    public function executeComponent()
    {
        $this->collectData();
        $this->includeTemplate();
    }

    /**
     * Собирает информацию о тесте
     */
    public function collectData ()
    {
        global $USER;
        if (!$USER->IsAuthorized()) {
            return;
        }
    }

    /**
     * Обрабатывает POST-запрос пользователя
     */
    public function processPost ()
    {
        if (!Tools::isPostRequestMethod()) {
            return;
        }
        if (isset($_POST["start_obsession_test"])) {
            $this->start();
            return;
        }
        if (isset($_POST["obsession_test_answer"])) {
            $this->processAnswerPost();
            return;
        }
    }

    /**
     * Подключает нужный шаблон в соответствии с текущим состоянием
     */
    public function includeTemplate ()
    {
        switch ($this->state) {
            case self::START_STATE:
                $templateName = "start.php";
                break;
            case self::QUESTION_STATE:
                $templateName = "question.php";
                break;
            case self::RESULT_STATE:
                $templateName = "result.php";
                break;
            default:
                throw new LogicException("Неизвестное состояние компонента");
        }
        $this->includeComponentTemplate($templateName);
    }
}
