<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
/**  
 * @var CMain $APPLICATION 
 */
use Application\Base\Bitrix\Component\FormResultNew;
use Preview\Reservation\Model as PreviewReservationModel;

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
                <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/preview_success_reservation.php")?>
            <?else:?>
                <?//На событие добавления этой формы соществует подписка в init.php
                $formCode = PreviewReservationModel::FORM_CODE;
                $APPLICATION->IncludeComponent(
                    "bitrix:form.result.new",
                    "preview",
                    FormResultNew::getDefaultParams($formCode)
                );?>
            <?endif?>
        </div>
    </div>
    <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/throw_events_sidebar.php")?>
</div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>

