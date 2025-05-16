<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->safeLoad();

$db = require __DIR__ . '/../config/db.php';
$pdo = new PDO("mysql:host={$db['host']};dbname={$db['name']};charset=utf8mb4", $db['user'], $db['pass']);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$files = glob(__DIR__ . '/migrations/*_up.sql');
sort($files);

foreach ($files as $file) {
    echo "Applying migration: $file\n";
    try {
        $sql = file_get_contents($file);
        $pdo->exec($sql);
    } catch (PDOException $e) {
        echo "Failed: {$e->getMessage()}\n";
        exit(1);
    }
}
