<?php
declare(strict_types=1);

session_start();

// Autoload dependencies via Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Bootstrap application (env variables, DI, error handlers, middleware, etc.)
$container = require_once __DIR__ . '/../bootstrap/app.php';

use App\Routes\Router;
use Psr\Log\LoggerInterface;

try {
    // Dispatch the router to handle the incoming HTTP request
    Router::dispatch();
} catch (\Throwable $e) {
    // Resolve logger from container
    /** @var LoggerInterface $logger */
    $logger = $container->get(LoggerInterface::class);
    $logger->error($e->getMessage(), ['exception' => $e]);

    // If in development mode, rethrow or display detailed error
    if (getenv('APP_ENV') === 'development') {
        throw $e;
    }

    // Otherwise, send HTTP 500 and render friendly error page
    http_response_code(500);
    // Clear any partially sent output
    if (ob_get_length()) {
        ob_end_clean();
    }

    // Load error template
    $errorView = __DIR__ . '/../app/Views/errors/500.php';
    if (file_exists($errorView)) {
        require $errorView;
    } else {
        echo '<h1>Application Error</h1>';
        echo '<p>Sorry, something went wrong. Please try again later.</p>';
    }
}
