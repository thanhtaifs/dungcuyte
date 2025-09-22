<?php
global $module_file;
echo "__DIR__ = " . __DIR__ . PHP_EOL;
echo "dirname(__DIR__) = " . dirname(__DIR__) . PHP_EOL;
echo "mainfile exists at __DIR__: " . (file_exists(__DIR__.'/mainfile.php') ? 'yes' : 'no') . PHP_EOL;
echo "mainfile exists at parent: " . (file_exists(dirname(__DIR__).'/mainfile.php') ? 'yes' : 'no') . PHP_EOL;
echo "mainfile exists at parent: " . (NV_ROOTDIR . '/modules/' . $module_file . '/functions.php') . PHP_EOL;