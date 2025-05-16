<?php
namespace App\Utils;

class FileCache
{
    protected string $cacheDir = __DIR__ . '/../../storage/cache/';

    public function get(string $key): mixed
    {
        $file = $this->cacheDir . md5($key) . '.cache';
        if (!file_exists($file) || filemtime($file) < time() - 3600) {
            return null;
        }
        return unserialize(file_get_contents($file));
    }

    public function set(string $key, mixed $value): void
    {
        $file = $this->cacheDir . md5($key) . '.cache';
        file_put_contents($file, serialize($value));
    }

    public function delete(string $key): void
    {
        $file = $this->cacheDir . md5($key) . '.cache';
        if (file_exists($file)) {
            unlink($file);
        }
    }
}