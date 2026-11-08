<?php
// Run after deploying or importing products: php tools/warm_product_images.php
if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit;
}
define('NV_MAINFILE', true);
define('NV_ROOTDIR', dirname(__DIR__));
define('NV_BASE_SITEURL', '/');
define('NV_UPLOADS_DIR', 'uploads');
define('NV_FILES_DIR', 'files');
require NV_ROOTDIR . '/modules/shops/responsive_images.php';

$directory = NV_ROOTDIR . '/uploads/shops';
if (!is_dir($directory)) {
    fwrite(STDERR, "Product upload directory does not exist.\n");
    exit(1);
}
$ready = $skipped = $original_bytes = $thumbnail_bytes = 0;
$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory, FilesystemIterator::SKIP_DOTS));
foreach ($iterator as $file) {
    if (!$file->isFile() || !preg_match('/\.(jpe?g|png|webp)$/i', $file->getFilename())) {
        continue;
    }
    $relative = str_replace('\\', '/', substr($file->getPathname(), strlen(NV_ROOTDIR) + 1));
    $result = nv_shops_card_image('/' . $relative);
    if ($result['srcset'] !== '') {
        ++$ready;
        $original_bytes += $file->getSize();
        $thumbnail_bytes += filesize(NV_ROOTDIR . $result['src']);
    } else {
        ++$skipped;
    }
}
echo json_encode(array('ready' => $ready, 'skipped' => $skipped, 'original_bytes' => $original_bytes, 'default_thumbnail_bytes' => $thumbnail_bytes), JSON_PRETTY_PRINT), PHP_EOL;
