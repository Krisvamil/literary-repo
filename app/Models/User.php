<?php
namespace App\Models;

class User extends Model
{
    public static function findByEmail(string $email): ?array
    {
        $stmt = self::$db->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
        $stmt->execute(['email' => $email]);
        return $stmt->fetch() ?: null;
    }
}