<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

define('NV_IS_MOD_NEWS', true);

require __DIR__ . '/modules/news/funcs/main.php';

echo "Module news load OK";