<?php
// --- [bootstrap/app.php] ---

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use App\Models\Model;
use App\Utils\Logger as AppLogger;

// Load .env
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->safeLoad();

// Global config and DB setup
$config = require __DIR__ . '/../config/config.php';
$dbConfig = require __DIR__ . '/../config/db.php';

// Logger boot
AppLogger::init(__DIR__ . '/../storage/logs/app.log');

set_exception_handler(function ($e) {
    http_response_code(500);
    AppLogger::error($e->getMessage(), ['exception' => $e]);
    include __DIR__ . '/../app/Views/errors/500.php';
    exit;
});

// PDO connection setup
$dsn = "mysql:host={$dbConfig['host']};dbname={$dbConfig['name']};charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $dbConfig['user'], $dbConfig['pass'], $options);
    Model::setConnection($pdo);
} catch (PDOException $e) {
    AppLogger::error('Database connection failed: ' . $e->getMessage());
    http_response_code(500);
    include __DIR__ . '/../app/Views/errors/500.php';
    exit;
}
