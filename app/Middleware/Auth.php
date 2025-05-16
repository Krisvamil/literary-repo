<?php
namespace App\Middleware;

class Auth
{
    public static function check(): bool
    {
        return isset($_SESSION['user']) && !empty($_SESSION['user']['id']);
    }

    public static function requireLogin(): void
    {
        if (!self::check()) {
            $_SESSION['flash'] = 'You must be logged in.';
            header('Location: /');
            exit;
        }
    }

    public static function isAuthor(): bool
    {
        return self::check() && ($_SESSION['user']['role'] ?? '') === 'author';
    }

    public static function isReader(): bool
    {
        return self::check() && ($_SESSION['user']['role'] ?? '') === 'reader';
    }

    public static function requireRole(string $role): void
    {
        if (!self::check() || ($_SESSION['user']['role'] ?? '') !== $role) {
            $_SESSION['flash'] = 'Access denied for role: ' . htmlspecialchars($role);
            header('Location: /dashboard');
            exit;
        }
    }
}