<?
/**
 * @var CMain $APPLICATION
 */
?>
<div class="hero-block">
    <div class="hero-block-inner">

        <h1><span>Ты — </span> <span>Изгой?</span></h1>

        <h2 class="text-uppercase-none">В тебе живёт один из 6 демонов. <br>
            Узнай, насколько ты одержим!  </h2>

        <h3>Авторизируйся, чтобы начать:</h3>

        <div class="auth-buttons">
            <?$APPLICATION->IncludeFile(PATH_TO_INCLUDE . "/throw/auth_component.php")?>
            <label>
                <input type="checkbox">
                <span>Согласен(а) на обработку <a href="#">персональных данных</a></span>
            </label>
        </div>

        <a href="#" class="blue-btn">Начать</a>
    </div>
</div>