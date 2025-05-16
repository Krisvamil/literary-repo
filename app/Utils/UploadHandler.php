<?php
namespace App\Utils;

class UploadHandler
{
    protected string $targetDir;

    public function __construct(?string $dir = null)
    {
        $this->targetDir = $dir ?? ($_ENV['UPLOAD_DIR'] ?? 'public/uploads');
        if (!is_dir($this->targetDir)) {
            mkdir($this->targetDir, 0755, true);
        }
    }

    public function upload(array $file): ?string
    {
        if ($file['error'] !== UPLOAD_ERR_OK) return null;

        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $safeName = uniqid('upload_', true) . '.' . $ext;
        $target = $this->targetDir . '/' . $safeName;

        if (move_uploaded_file($file['tmp_name'], $target)) {
            return $safeName;
        }

        return null;
    }
}
