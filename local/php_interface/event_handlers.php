<?
use Preview\Reservation\Model as PreviewReservationModel;

AddEventHandler("form", "onAfterResultAdd", array(PreviewReservationModel::class, "blockUserAfterSave"));