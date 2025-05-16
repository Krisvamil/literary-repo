<?php

namespace App\Controllers;

class BaseController 
{
    /**
     * Render an HTML view within the main layout.
     *
     * @param string $view   Path to view file (relative to app/Views, without .php)
     * @param array  $data   Variables to extract into the view scope
     */
    protected function view(string $view, array $data = []): void
    {
        // Resolve view file path
        $viewPath = __DIR__ . '/../Views/' . str_replace('.', '/', $view) . '.php';
        if (!file_exists($viewPath)) {
            throw new \RuntimeException("View [{$view}] not found at {$viewPath}");
        }

        // Extract data for use in view
        extract($data, EXTR_SKIP);

        // Capture view output
        ob_start();
        include $viewPath;
        $content = ob_get_clean();

        // Include layout, which should echo $content where appropriate
        $layoutPath = __DIR__ . '/../Views/layout.php';
        if (!file_exists($layoutPath)) {
            throw new \RuntimeException("Layout not found at {$layoutPath}");
        }

        include $layoutPath;
    }

    /**
     * Redirect to a different URL and terminate.
     *
     * @param string $url
     * @param int    $statusCode HTTP status code (default: 302)
     */
    protected function redirect(string $url, int $statusCode = 302): void
    {
        http_response_code($statusCode);
        header('Location: ' . $url);
        exit;
    }

    /**
     * Send a JSON response and terminate.
     *
     * @param mixed $data    Data to be JSON-encoded
     * @param int   $status  HTTP status code (default: 200)
     */
    protected function json($data, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        exit;
    }

    /**
     * Retrieve a request input, or return default.
     *
     * @param string $key
     * @param mixed  $default
     * @return mixed
     */
    protected function input(string $key, $default = null)
    {
        return $_REQUEST[$key] ?? $default;
    }
}