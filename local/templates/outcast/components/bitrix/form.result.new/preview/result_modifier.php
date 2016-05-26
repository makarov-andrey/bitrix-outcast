<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/**
 * @var array $arResult
 */
use Preview\City\Model as CityModel;
use Preview\Reservation\Model as ReservationModel;

$cityModel = new CityModel();
$reservationModel = new ReservationModel();

foreach ($arResult["QUESTIONS"] as $code => &$arQuestion) {
    $arQuestion["TYPE"] = $arQuestion["STRUCTURE"][0]["FIELD_TYPE"];
    $arQuestion["INPUT_NAME"] = "form_" . $arQuestion["TYPE"] . "_" . $arQuestion["STRUCTURE"][0]["ID"];
    if ($code == "city") {
        $arQuestion["TYPE"] = "cities";
        $arQuestion["CITIES"] = $cityModel->getList();
        foreach ($arQuestion["CITIES"] as &$city) {
            $city["RESERVATIONS_EXPIRE"] = $reservationModel->countForCity($city["ID"]);
            $city["RESERVATIONS_BALANCE"] = $city["RESERVATIONS_AMOUNT"] - $city["RESERVATIONS_EXPIRE"];
            $city["RESERVATIONS_BLOCKED"] = $city["RESERVATIONS_BALANCE"] <= 0;
        }
        unset($city);
    }
    if ($code == "phone") {
        $arQuestion["TYPE"] = "tel";
    }
}
unset($arQuestion);

$arResult["SUBMIT_BUTTON"] = str_replace("<input", "<input class=\"blue-btn\"", $arResult["SUBMIT_BUTTON"]);
