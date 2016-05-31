<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/**
 * @var CMain $APPLICATION
 * @var array $arResult
 * @var array $arParams
 */
?>

<script>
    var Auth = {};
    <?foreach($arResult["AUTH_SERVICES"] as $key => $arService):?>
        Auth["<?=$key?>"] = function() {
            <?=htmlspecialchars_decode($arService["ONCLICK"])?>
        };
    <?endforeach?>

    function authorize (service) {
        var $acceptTermsCheckbox = $(".require-accept-terms");
        if ($acceptTermsCheckbox.length && !$acceptTermsCheckbox.is(":checked")) {
            return;
        }
        Auth[service]();
    }
</script>

<div class="auth-buttons">
    <?foreach($arResult["AUTH_SERVICES"] as $key => $arService):?>
        <a href="javascript: void(0)" onclick="authorize('<?=$key?>')" class="transparent-btn">
            <?$APPLICATION->IncludeFile($arService["ICON_FILE"])?>
            <?=$arService["NAME"]?>
        </a>
    <?endforeach?>
    <?if($arParams["require_accept_terms"]):?>
        <label>
            <input type="checkbox" class="require-accept-terms">
            <span>Согласен(а) на обработку персональных данных</span>
        </label>
    <?endif?>
</div>