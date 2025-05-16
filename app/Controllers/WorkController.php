<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Middleware\Auth;
use App\Models\Work;

class WorkController extends BaseController
{
    public function index(): void
    {
        Auth::requireLogin();
        $works = Work::all();
        $title = 'All Works';
        $content = __DIR__ . '/../Views/works/index.php';
        $this->view($content, compact('title', 'works'));
    }

    public function create(): void
    {
        Auth::requireLogin();
        $title = 'New Work';
        $content = __DIR__ . '/../Views/works/create.php';
        $this->view($content, compact('title'));
    }

    public function store(): void
    {
        Auth::requireLogin();

        $data = [
            'title' => $_POST['title'] ?? '',
            'content' => $_POST['content'] ?? '',
            'author_id' => $_SESSION['user']['id'] ?? null,
        ];

        if ($data['title'] && $data['content']) {
            Work::create($data);
            header('Location: /works');
            exit;
        }

        $_SESSION['flash'] = 'Title and content required.';
        header('Location: /works/create');
        exit;
    }

     public function uploadForm(): void
    {
        $title = 'Upload Cover';
        $content = __DIR__ . '/../Views/works/upload.php';
        $this->view($content, compact('title'));
    }

    public function handleUpload(): void
    {
        $uploader = new \App\Utils\UploadHandler();
        $filename = $uploader->upload($_FILES['cover'] ?? []);

        if ($filename) {
            $_SESSION['flash'] = "Upload successful: $filename";
        } else {
            $_SESSION['flash'] = "Upload failed.";
        }

        header('Location: /works/upload');
        exit;
    }
}