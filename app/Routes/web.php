<?php
use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\WorkController;
use App\Controllers\AuthorController;
use App\Controllers\ReaderController;

$auth = new AuthController();
$dashboard = new DashboardController();
$works = new WorkController();
$author = new AuthorController();
$reader = new ReaderController();

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

switch ([$uri, $method]) {
    // Auth
    case ['/', 'GET']:
        $auth->showLogin();
        break;
    case ['/login', 'POST']:
        $auth->login();
        break;
    case ['/logout', 'GET']:
        $auth->logout();
        break;

    // Dashboard
    case ['/dashboard', 'GET']:
        $dashboard->index();
        break;

    // Works
    case ['/works', 'GET']:
        $works->index();
        break;
    case ['/works/create', 'GET']:
        $works->create();
        break;
    case ['/works/store', 'POST']:
        $works->store();
        break;
    case ['/works/upload', 'GET']:
        $works->uploadForm();
        break;
    case ['/works/upload', 'POST']:
        $works->handleUpload();
        break;

    // Author / Reader
    case ['/author/profile', 'GET']:
        $author->profile();
        break;
    case ['/reader/dashboard', 'GET']:
        $reader->dashboard();
        break;

    default:
        http_response_code(404);
        include __DIR__ . '/../Views/errors/404.php';
        break;
}

