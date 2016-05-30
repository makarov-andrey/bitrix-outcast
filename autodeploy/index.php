<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/application/autoload.php";
require_once __DIR__ . "/gitignore_config.php";

if (!defined("AUTO_DEPLOY_TOKEN") || $_GET["token"] != AUTO_DEPLOY_TOKEN) {
    die("Access denied");
}

use Develop\Deploy;
use Develop\Notification;

try {
    Deploy::start(FORCE_AUTO_DEPLOY);
    echo "ok";
} catch (Exception $exception) {
    $subject = "При разворачивания проекта возникла ошибка";
    $message = $exception->getMessage();
    $message .= "\n\nBacktrace:\n" . $exception->getTraceAsString();

    Notification::notify($subject, $message);
    echo $message;
}
