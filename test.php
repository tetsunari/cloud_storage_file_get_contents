<?php
require __DIR__ . '/vendor/autoload.php';

use Google\Cloud\Storage\StorageClient;

$images = 'file/トランクス.jpg';

$productId = 'lunar-caster-347010';

$auth_key = __DIR__ . 'json_key/lunar-caster-347010-6adb1077a9f6.json';

$bucket_name = 'matu-test-storage';

$header = ['Content-type: application/json'];


//$curl = curl_init();
//curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
//curl_setopt($curl, CURLOPT_POSTFIELDS, $auth_key);
//curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//
//$response = curl_exec($curl);
//$curl_info = curl_getinfo($curl);
//curl_close($curl);

//if ($curl_info['http_code'] !== 200) return;

//$storage = new StorageClient([
//    'projectId' => $productId,
//    'keyFile' => json_decode($response, true)
//]);

$storage = new StorageClient([
    'projectId' => $productId,
    'keyFile' => json_decode(file_get_contents($auth_key, true), true)
]);

$bucket = $storage->bucket($bucket_name);

$option = ['name' => $images];

$fp = fopen("{$images}", 'r');
$object = $bucket->upload(
    $fp,
    $option
);

echo gettype($object). PHP_EOL;

echo "[{$images}]のアップロード完了";