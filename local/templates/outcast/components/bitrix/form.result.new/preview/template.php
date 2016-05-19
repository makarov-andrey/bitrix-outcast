<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/**
 * @var array $arResult
 */
?>
<h3>Записывайся скорее, пока не разобрали
    все билеты, организаторы с тобой свяжутся. </h3>
<p>Все поля обязательны для заполнения. </p>
<?if (!empty($arResult["FORM_ERRORS_TEXT"])):?>
    <?=$arResult["FORM_ERRORS_TEXT"]?>
<?endif?>
<?=$arResult["FORM_HEADER"]?>
    <?foreach ($arResult["QUESTIONS"] as $arQuestion):?>
        <label for="<?=$arQuestion["INPUT_NAME"]?>"><?=$arQuestion["CAPTION"]?></label>
        <?switch($arQuestion["TYPE"]) {
            case "text":
            case "tel":
            case "email":?>
                <input
                    type="<?=$arQuestion["TYPE"]?>"
                    id="<?=$arQuestion["INPUT_NAME"]?>"
                    name="<?=$arQuestion["INPUT_NAME"]?>"
                    <?if($arQuestion["REQUIRED"] == "Y"):?>
                        required
                    <?endif?>
                >
                <?break;
            case "cities": ?>
                <select name="<?= $arQuestion["INPUT_NAME"] ?>" id="<?=$arQuestion["INPUT_NAME"]?>">
                    <?foreach ($arQuestion["CITIES"] as $arCity):?>
                        <option value="<?=$arCity["ID"]?>" <?=($arCity["RESERVATIONS_BLOCKED"] ? "disabled" : "")?>>
                            <?=$arCity["NAME"]?>
                            <?if(!$arCity["RESERVATIONS_BLOCKED"]):?>
                                (осталось <?=$arCity["RESERVATIONS_BALANCE"]?>)
                            <?else:?>
                                (мест больше нет)
                            <?endif?>
                        </option>
                    <?endforeach?>
                </select>
                <?break;
            default:?>
                <?=$arQuestion["HTML_CODE"]?>
                <?break;
        }?>
    <?endforeach?>
    <?=$arResult["SUBMIT_BUTTON"]?>
<?=$arResult["FORM_FOOTER"]?>