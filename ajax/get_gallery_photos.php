<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php";

$output = array(
    "success" => true
);

try {
    ob_start();
    include $_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/include/gallery_content.php";
    $output["content"] = ob_get_clean();
} catch (InvalidArgumentException $exception) {
    $output["success"] = false;
    $output["error"] = $exception->getMessage();
}

echo json_encode($output);
