<? require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
/**
 * @var CMain $APPLICATION
 */
$APPLICATION->SetTitle("Правила");
?>

<div class="content">
    <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/rules_wide_banner.php")?>
    <div class="post-banner-content">
        <div class="container row three-columns-template">
            <div class="column">
                <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/rules_side_nav.php")?>
                <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/rules_side_photo_contest.php")?>
            </div>
            <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/rules_content.php")?>
            <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/throw_sidebar.php")?>
        </div>
    </div>
</div>

<? require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php'); ?>

