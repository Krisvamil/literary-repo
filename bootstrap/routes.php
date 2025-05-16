<?php

use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\WorkController;
use App\Controllers\AuthorController;
use App\Controllers\ReaderController;
use App\Routes\Router;
use App\Middleware\Auth;

// Public
Router::get('/', [DashboardController::class, 'index']);
Router::get('/login', [AuthController::class, 'showLoginForm']);
Router::post('/login', [AuthController::class, 'login']);
Router::get('/logout', [AuthController::class, 'logout']);

// Protected
Router::group(['middleware' => Auth::class], function() {
    Router::get('/dashboard', [DashboardController::class, 'index']);

    // Authors
    Router::get('/authors', [AuthorController::class, 'index']);
    Router::get('/authors/{id}', [AuthorController::class, 'show']);
    Router::get('/authors/{id}/profile', [AuthorController::class, 'profile']);
    Router::post('/authors', [AuthorController::class, 'store']);
    Router::put('/authors/{id}', [AuthorController::class, 'update']);
    Router::delete('/authors/{id}', [AuthorController::class, 'destroy']);

    // Works
    Router::get('/works', [WorkController::class, 'index']);
    Router::get('/works/create', [WorkController::class, 'create']);
    Router::post('/works', [WorkController::class, 'store']);
    Router::get('/works/{id}', [WorkController::class, 'show']);
    Router::get('/works/{id}/upload', [WorkController::class, 'uploadForm']);
    Router::post('/works/{id}/upload', [WorkController::class, 'upload']);
    Router::put('/works/{id}', [WorkController::class, 'update']);
    Router::delete('/works/{id}', [WorkController::class, 'destroy']);

    // Readers
    Router::get('/readers', [ReaderController::class, 'index']);
    Router::get('/readers/{id}', [ReaderController::class, 'show']);
    Router::get('/readers/{id}/dashboard', [ReaderController::class, 'dashboard']);
    Router::post('/readers', [ReaderController::class, 'store']);
    Router::put('/readers/{id}', [ReaderController::class, 'update']);
    Router::delete('/readers/{id}', [ReaderController::class, 'destroy']);

});

// Fallback
Router::fallback(function() {
    http_response_code(404);
    include __DIR__ . '/../app/Views/errors/404.php';
});
