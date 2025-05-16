<?php
namespace App\Controllers;

use App\Middleware\Auth;
use App\Models\Reader;
use App\Controllers\BaseController;

class ReaderController extends BaseController
{
    public function dashboard(): void
    {
        Auth::requireLogin();

        $user = $_SESSION['user'] ?? null;
        if (!$user || empty($user['id'])) {
            $_SESSION['flash'] = 'Unauthorized access.';
            header('Location: /');
            exit;
        }

        $reader = (new Reader())->find($user['id']);
        if (!$reader) {
            $_SESSION['flash'] = 'Reader not found.';
            header('Location: /dashboard');
            exit;
        }

        $title = 'Reader Dashboard';
        $content = __DIR__ . '/../Views/readers/dashboard.php';
        $this->view($content, ['title' => $title, 'reader' => $reader, 'layout' => 'main']);
    }
}
