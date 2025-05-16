<?php
namespace App\Models;

use PDO;

class Model
{
    protected static PDO $db;

    public static function setConnection(PDO $pdo): void
    {
        static::$db = $pdo;
    }

    protected static function table(): string
    {
        return strtolower((new \ReflectionClass(static::class))->getShortName()) . 's';
    }

    public static function all(): array
    {
        $table = static::table();
        $stmt = self::$db->query("SELECT * FROM {$table}");
        return $stmt->fetchAll() ?: [];
    }

    public function find(int $id): ?array
    {
        $table = static::table();
        $stmt = self::$db->prepare("SELECT * FROM {$table} WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }
}