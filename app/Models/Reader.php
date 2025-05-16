<?php
namespace App\Models;

class Reader extends User
{
    public static function comments(int $readerId): array
    {
        $stmt = self::$db->prepare('SELECT * FROM comments WHERE reader_id = :reader_id');
        $stmt->execute(['reader_id' => $readerId]);
        return $stmt->fetchAll() ?: [];
    }
}