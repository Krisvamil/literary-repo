<?php
namespace App\Models;

class Work extends Model
{
    public static function create(array $data): bool
    {
        $stmt = self::$db->prepare(
            'INSERT INTO works (title, content, author_id, created_at) VALUES (:title, :content, :author_id, NOW())'
        );
        return $stmt->execute($data);
    }
}
