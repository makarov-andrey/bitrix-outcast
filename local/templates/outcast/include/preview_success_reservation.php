<?
use Preview\Reservation\Model as ReservationModel;
use Preview\City\Model as CityModel;

$reservationModel = new ReservationModel();
$cityModel = new CityModel();

$userResult = $reservationModel->findForCurrentUser();
$city = null;
if (!empty($userResult)) {
    $city = $cityModel->find($userResult["city"]);
}
?>
<h2>
    Вы успешно зарегистрировались!<br>
    Ждем вас на предпоказ
    <?if(!is_null($city)):?>
        <br>
        <?if (!empty($city["ADDRESS"])):?>
            по адресу "<?=$city["ADDRESS"]?>"
        <?endif?>
        <?if (!empty($city["TIME"])):?>
            в <?=$city["TIME"]?>
        <?endif?>
    <?endif?>
</h2>