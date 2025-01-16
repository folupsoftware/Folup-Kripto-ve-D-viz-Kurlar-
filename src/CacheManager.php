<?php

namespace FolupExchange;

class CacheManager
{
    private $cacheDir = __DIR__ . '/cache/';
    private $defaultDuration = 600; // 10 dakika

    public function __construct($cacheDir = null, $defaultDuration = null)
    {
        if ($cacheDir) {
            $this->cacheDir = $cacheDir;
        }

        if ($defaultDuration) {
            $this->defaultDuration = $defaultDuration;
        }

        if (!is_dir($this->cacheDir)) {
            mkdir($this->cacheDir, 0777, true);
        }
    }

    public function isCacheValid($key)
    {
        $file = $this->getCacheFile($key);
        return file_exists($file) && (time() - filemtime($file) < $this->defaultDuration);
    }

    public function getCache($key)
    {
        $file = $this->getCacheFile($key);
        if (!file_exists($file)) {
            return null;
        }

        return json_decode(file_get_contents($file), true);
    }

    public function setCache($key, $data)
    {
        $file = $this->getCacheFile($key);
        file_put_contents($file, json_encode($data));
    }

    private function getCacheFile($key)
    {
        return $this->cacheDir . md5($key) . '.json';
    }
}
