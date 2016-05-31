<?php
/**
 * @var CMain $APPLICATION
 * @var array $arResult
 */
?>

<div class="test-block">

    <div class="question-num">
        <div class="current">1</div>
        <div class="max"><?=count($arResult["QUESTIONS"])?></div>
    </div>

    <form class="obsession-test-form" action="<?=$APPLICATION->GetCurPage()?>" method="post">
        <input type="hidden" name="obsession_test" value="Y">
        <?$i = 0?>
        <?foreach($arResult["QUESTIONS"] as $question):?>
            <div class="question <?=($i == 0 ? "active" : "")?>">
                <div class="question-text"><?=$question["NAME"]?></div>
                <div class="question-answers">
                    <?foreach($question["ANSWER_VARIANTS"] as $variant):?>
                        <input type="radio" name="answers[<?=$question["ID"]?>]" value="<?=$variant["ID"]?>" id="answer-<?=$variant["ID"]?>"><label class="answer transparent-btn" for="answer-<?=$variant["ID"]?>"><?=$variant["NAME"]?></label>
                    <?endforeach;?>
                </div>
            </div>
            <?$i++?>
        <?endforeach?>
        <input type="submit" class="blue-btn" value="Далее">
    </form>
</div>
