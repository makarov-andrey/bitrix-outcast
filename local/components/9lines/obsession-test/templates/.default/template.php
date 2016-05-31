<?php
/**
 * @var CMain $APPLICATION
 * @var array $arResult
 */
?>

<div class="test-block">

    <div class="question-num">
        <div class="current">1</div>
        <div class="max">9</div>
    </div>

    <form action="<?=$APPLICATION->GetCurPage()?>">
        <div class="question-text">
            Как часто с тобой происходят вещи,
            которые ты не в силах объяснить?
        </div>
/
        <div class="question-answers">
            <input type="radio" name="test1" id="radio1"><label class="answer transparent-btn" for="radio1">часто</label>
            <input type="radio" name="test1" id="radio2"><label class="answer transparent-btn" for="radio2">редко</label>
            <input type="radio" name="test1" id="radio3"><label class="answer transparent-btn" for="radio3">метко</label>
            <input type="radio" name="test1" id="radio4"><label class="answer transparent-btn" for="radio4">пусто</label>
        </div>

        <input type="button" class="blue-btn js--next-question" value="Далее">
    </form>
</div>
