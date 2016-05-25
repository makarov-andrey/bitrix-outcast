<?
/**
 * @var CUser $USER
 */
?>
<?if($USER->IsAuthorized()):?>
    <h3 class="text-center">Вы вошли, как <?=$USER->GetFullName()?> <a href="?logout=yes">Выйти</a></h3>
<?endif?>