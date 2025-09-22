<?php
$module = $_GET['nv'] ?? '';
if ($module === 'news') {
    require __DIR__ . '/modules/news/funcs/main.php';
    exit;
}
echo "Không phải module news";