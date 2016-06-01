<?
/**
 * @var CMain $APPLICATION
 */

$authParams = array(
    "require_accept_terms" => true
);
?>
<div class="hero-block">
    <div class="hero-block-inner">

        <h1><span>Ты — </span> <span>Изгой?</span></h1>

        <h2 class="text-uppercase-none">В тебе живёт один из 6 демонов. <br>
            Узнай, насколько ты одержим!  </h2>

        <h3>Авторизируйся, чтобы начать:</h3>

        <div class="auth-buttons">
            <?$APPLICATION->IncludeFile(PATH_TO_INCLUDE . "/throw/auth_component.php", $authParams)?>
        </div>

        <a href="javascript: void(0);" class="blue-btn">Начать</a>
    </div>
</div>