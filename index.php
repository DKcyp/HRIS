<?php

/**
 * Laravel HRIS V2 - Entry Point
 * Forward all requests to public/index.php
 */

// Change working directory to public
$publicPath = __DIR__ . '/public';

if (is_file($publicPath . '/index.php')) {
    chdir($publicPath);
    require $publicPath . '/index.php';
} else {
    die('Laravel installation error: public/index.php not found');
}

