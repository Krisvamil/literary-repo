<?php
namespace App\Utils;

use Monolog\Logger as MonoLogger;
use Monolog\Handler\StreamHandler;

class Logger
{
    protected static MonoLogger $logger;

    public static function init(string $path): void
    {
        self::$logger = new MonoLogger('app');
        self::$logger->pushHandler(new StreamHandler($path, MonoLogger::DEBUG));
    }

    public static function info(string $message, array $context = []): void
    {
        self::$logger->info($message, $context);
    }

    public static function error(string $message, array $context = []): void
    {
        self::$logger->error($message, $context);
    }

    public static function debug(string $message, array $context = []): void
    {
        self::$logger->debug($message, $context);
    }
}
