<?php

spl_autoload_register(function($className){
    $className = str_replace("\\", "/", $className);
    $filename = __DIR__ . "/" . $className . ".php";
    if (file_exists($filename)) {
        include $filename;
    }
});