<?php
namespace App\Controllers;

use App\Models\User;
use App\Controllers\BaseController;

class AuthController extends BaseController
{
    public function showLogin(): void
    {
        $title = 'Login';
        $error = $_SESSION['flash'] ?? null;
        unset($_SESSION['flash']);
        $content = __DIR__ . '/../Views/login.php';
        $this->view($content, ['title' => $title, 'error' => $error, 'layout' => 'guest']);
    }

    public function login(): void
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = User::findByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            unset($user['password']);
            $_SESSION['user'] = $user;
            header('Location: /dashboard');
            exit;
        }

        $_SESSION['flash'] = 'Invalid email or password.';
        header('Location: /');
        exit;
    }

    public function logout(): void
    {
        session_destroy();
        session_start();
        $_SESSION['flash'] = 'You have been logged out.';
        header('Location: /');
        exit;
    }
}