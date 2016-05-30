<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php";
use PhotoGallery\NewsListHelper as PhotoGalleryNewsListHelper;

$output = array(
    "success" => true
);

try {
    ob_start();
    $APPLICATION->IncludeComponent(
	    "bitrix:news.list",
	    "photo_gallery",
	    PhotoGalleryNewsListHelper::getDefaultParams(true)
	);
    $output["content"] = ob_get_clean();
} catch (InvalidArgumentException $exception) {
    $output["success"] = false;
    $output["error"] = $exception->getMessage();
}

echo json_encode($output);
