<?php
require __DIR__ . '/vendor/autoload.php';

use Google\Cloud\Storage\StorageClient;

$images = 'file/トランクス.jpg';

$productId = 'lunar-caster-347010';

$auth_key = __DIR__ . '/json_key/lunar-caster-347010-6adb1077a9f6.json';

$bucket_name = 'matu-test-storage';

$header = ['Content-type: application/json'];

try {
    $storage = new StorageClient([
        'projectId' => $productId,
        'keyFile' => json_decode(file_get_contents($auth_key, true), true)
    ]);
} catch (Exception $e) {
    echo $e;
    exit();
}


$option = ['name' => $images];

try {
    $fp = fopen("{$images}", 'r');
    $bucket = $storage->bucket($bucket_name);
    $object = $bucket->upload(
        $fp,
        $option
    );
} catch (Exception $e) {
    echo $e;
    exit();
}

echo gettype($object). PHP_EOL;

echo "[{$images}]のアップロード完了";