<?php
    $folderPath = dirname($_SERVER['SCRIPT_FILENAME']);
    $urlPath = $_SERVER['REQUEST_URI'];
    $url = substr($urlPath, 10);

    define("URL", $url);