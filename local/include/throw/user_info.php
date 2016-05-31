<?
/**
 * @var CUser $USER
 */
use User\Model as UserModel;

if (!$USER->IsAuthorized()) {
    return;
}

$avatarId = UserModel::getCurrentUserAvatarId();
$avatar = null;
if (!is_null($avatarId)) {
    $sizes = array(
        "width" => 70,
        "height" => 70
    );
    $avatar = CFile::ResizeImageGet($avatarId, $sizes, BX_RESIZE_IMAGE_EXACT);
}
?>
<div class="auth-icon-wrapper">
    <div class="auth-img">
        <?if(!is_null($avatar)):?>
            <img src="<?=$avatar["src"]?>" alt="ava">
        <?endif?>
    </div>
    <a href="?logout=yes" class="auth-exit"><img src="<?=SITE_TEMPLATE_PATH?>/images/close.png" alt="exit"></a>
</div>