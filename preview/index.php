<? require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
use Application\Tools;
use Preview\Reservation\Model as PreviewReservationModel;
/**
 * @var CMain $APPLICATION
 */
$APPLICATION->SetTitle("Предпоказ");
$APPLICATION->SetPageProperty("main-block-class", "main-page");
?>

<div class="content">
    <div class="hero-block form-block">
        <div class="hero-block-inner">
            <h3 class="text-uppercase">Предпремьерный показ пилотной серии</h3>
            <h1><span>28 мая</span> в 5 городах</h1>
            <h2>Не упусти свой шанс увидеть первым новый сериал «Изгой»</h2>
            <?if(PreviewReservationModel::isUserBlocked()):?>
                <h2>Вы успешно зарегистрировались! Ждем вас на предпоказ!</h2>
            <?else:?>
                <?//На событие добавления этой формы соществует подписка в init.php
                $formCode = PreviewReservationModel::FORM_CODE;
                $APPLICATION->IncludeComponent(
                    "bitrix:form.result.new",
                    "preview",
                    Tools::getDefaultWebFormResultNewComponentParams($formCode)
                );?>
            <?endif?>
        </div>
    </div>
    <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/throw_sidebar.php")?>
</div>

<? require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php'); ?>

