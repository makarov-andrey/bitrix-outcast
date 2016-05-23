<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>

<?foreach($arResult["AUTH_SERVICES"] as $arService):?>
    <a href="javascript: void(0)" class="<?=$arService["CLASS"]?>" onclick="if (!$(this).is('.disabled')){<?=$arService["ONCLICK"]?>}"><?=$arService["CLASS"]?> Войти</a><br>
<?endforeach?>