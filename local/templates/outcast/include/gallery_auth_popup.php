<?
/**
 * @var CMain $APPLICATION
 */
?>
<div class="auth-popup-outer popup-outer"></div>
<div class="auth-popup popup">
    <div class="close"></div>

    <div class="popup-content">
        <h2 class="text-uppercase">Авторизируйся <br>
            через свою любимую социальную сеть, <br>
            чтобы участвовать в голосовании</h2>

        <?$APPLICATION->IncludeComponent(
            "bitrix:system.auth.form",
            "",
            Array(
                "REGISTER_URL" => "",
                "FORGOT_PASSWORD_URL" => "",
                "PROFILE_URL" => "",
                "SHOW_ERRORS" => "N",
            ),
            false
        );?>
    </div>
</div>