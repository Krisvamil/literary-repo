<?php
namespace App\Controllers;

use App\Middleware\Auth;
use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index(): void
    {
        Auth::requireLogin();
        $title = 'Dashboard';
        $content = __DIR__ . '/../Views/dashboard.php';
        $this->view($content, ['title' => $title, 'layout' => 'main']);
    }
}
