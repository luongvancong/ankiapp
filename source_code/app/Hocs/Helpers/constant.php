<?php
$root = realpath(dirname(__FILE__) . '/../../../');

$app_path = $root . '/app/';

$public_path = $root . '/public/';

// Base path
define('BASE_PATH', realpath(rtrim($app_path, '/') . '/..') . '/');


define('PATH_STATIC', '/');
// define('PATH_STATIC', '/');

// Path assets
define('PATH_ASSETS', '/assets/');
