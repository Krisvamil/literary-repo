<?php
namespace App\Controllers;

use App\Middleware\Auth;
use App\Models\Author;
use App\Controllers\BaseController;

class AuthorController extends BaseController
{
    public function profile(): void
    {
        Auth::requireLogin();

        $user = $_SESSION['user'] ?? null;
        if (!$user || empty($user['id'])) {
            $_SESSION['flash'] = 'Unauthorized access.';
            header('Location: /');
            exit;
        }

        $author = (new Author())->find($user['id']);
        if (!$author) {
            $_SESSION['flash'] = 'Author not found.';
            header('Location: /dashboard');
            exit;
        }

        $title = 'Author Profile';
        $content = __DIR__ . '/../Views/authors/profile.php';
        $this->view($content, ['title' => $title, 'author' => $author, 'layout' => 'main']);
    }
}