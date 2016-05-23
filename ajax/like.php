<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php";
use PhotoGallery\Model;

$output = array(
    "success" => true
);

try {
    $model = new Model();
    $photoId = intval($_GET["photo_id"]);
    $model->toggleCurrentUserLike($photoId);
    $output["amount"] = $model->countLikes($photoId);
} catch (InvalidArgumentException $exception) {
    $output["success"] = false;
    $output["error"] = $exception->getMessage();
}

echo json_encode($output);
