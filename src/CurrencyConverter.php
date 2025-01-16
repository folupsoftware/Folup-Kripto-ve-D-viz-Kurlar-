<?php

namespace FolupExchange;

class CurrencyConverter
{
    private $apiUrl = "https://api.exchangerate-api.com/v4/latest/USD"; // Örnek API URL'si
    private $cacheFile = __DIR__ . '/cache/currency.json';
    private $cacheDuration = 60; // 1 dakika

    public function getRates()
    {
        if ($this->isCacheValid()) {
            return json_decode(file_get_contents($this->cacheFile), true);
        }

        $data = file_get_contents($this->apiUrl);
        file_put_contents($this->cacheFile, $data);

        return json_decode($data, true);
    }

    private function isCacheValid()
    {
        return file_exists($this->cacheFile) && (time() - filemtime($this->cacheFile) < $this->cacheDuration);
    }

    public function convert($from, $to, $amount = 1)
    {
        $rates = $this->getRates();
        if (!isset($rates['rates'][$from]) || !isset($rates['rates'][$to])) {
            throw new \Exception("Currency not found.");
        }

        $rate = $rates['rates'][$to] / $rates['rates'][$from];
        return $amount * $rate;
    }
}
