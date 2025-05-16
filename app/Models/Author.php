<?php
namespace App\Models;

class Author extends User
{
    public static function works(int $authorId): array
    {
        $stmt = self::$db->prepare('SELECT * FROM works WHERE author_id = :author_id');
        $stmt->execute(['author_id' => $authorId]);
        return $stmt->fetchAll() ?: [];
    }
}