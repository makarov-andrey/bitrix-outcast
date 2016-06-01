<?
/**
 * @var CUser $USER
 * @var CMain $APPLICATION
 */
$userAuthorized = $USER->IsAuthorized();
/*
 * Значение параметра show_thank_you_auth заносится в сессию в событии
 * onAfterUserLogin в init.php
 */
if ($userAuthorized && $_SESSION["show_thank_you_auth"]) {
    unset($_SESSION["show_thank_you_auth"]);
    $showOnLoad = true;
} else {
    $showOnLoad = false;
}
?>
<div class="auth-popup-outer popup-outer"></div>
<div class="auth-popup popup <?=($showOnLoad ? "js--onload-show" : "")?>">
    <div class="close"></div>

    <div class="popup-content">
        <?if ($userAuthorized):?>
            <h2>Спасибо за авторизацию! Теперь вы можете отмечать понравившиеся фотографии!</h2>
        <?else:?>
            <h2 class="text-uppercase">Авторизируйся <br>
                через свою любимую социальную сеть, <br>
                чтобы участвовать в голосовании</h2>

            <?$APPLICATION->IncludeFile(PATH_TO_INCLUDE . "/throw/auth_component.php")?>
        <?endif?>
    </div>
</div>