<?php

require 'vendor/autoload.php';

use FolupExchange\CurrencyConverter;
use FolupExchange\CryptoConverter;
use FolupExchange\CacheManager;

$type = $_GET['type'] ?? null;
$from = $_GET['from'] ?? null;
$to = $_GET['to'] ?? null;

$cacheManager = new CacheManager();

if ($type === "currency") {
    $converter = new CurrencyConverter();
    $result = $converter->convert($from, $to);
} elseif ($type === "crypto") {
    $converter = new CryptoConverter($cacheManager);
    $result = $converter->getRate($from, $to);
} else {
    echo json_encode(["error" => "Invalid type"]);
    exit;
}

echo json_encode(["result" => $result]);
