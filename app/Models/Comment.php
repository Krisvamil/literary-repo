<?php
namespace App\Models;

class Comment extends Model
{
    public static function forWork(int $workId): array
    {
        $stmt = self::$db->prepare('SELECT * FROM comments WHERE work_id = :wid ORDER BY created_at ASC');
        $stmt->execute(['wid' => $workId]);
        return $stmt->fetchAll() ?: [];
    }

    public static function create(array $data): bool
    {
        $stmt = self::$db->prepare(
            'INSERT INTO comments (work_id, reader_id, body, created_at) VALUES (:work_id, :reader_id, :body, NOW())'
        );
        return $stmt->execute($data);
    }
}