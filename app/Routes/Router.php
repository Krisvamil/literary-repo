<?php

namespace App\Routes;

use App\Middleware\Auth;

class Router extends Auth
{
    protected static array $routes = [];
    protected static array $groupMiddleware = [];
    protected static $fallback;

    public static function get(string $uri, $action): void
    {
        self::addRoute('GET', $uri, $action);
    }

    public static function post(string $uri, $action): void
    {
        self::addRoute('POST', $uri, $action);
    }

    public static function put(string $uri, $action): void
    {
        self::addRoute('PUT', $uri, $action);
    }

    public static function delete(string $uri, $action): void
    {
        self::addRoute('DELETE', $uri, $action);
    }

    public static function group(array $attrs, callable $callback): void
    {
        if (isset($attrs['middleware'])) {
            self::$groupMiddleware[] = $attrs['middleware'];
        }

        $callback();

        if (isset($attrs['middleware'])) {
            array_pop(self::$groupMiddleware);
        }
    }

    public static function fallback(callable $callback): void
    {
        self::$fallback = $callback;
    }

    protected static function addRoute(string $method, string $uri, $action): void
    {
        $middleware = self::$groupMiddleware;
        self::$routes[$method][$uri] = [
            'action' => $action,
            'middleware' => $middleware,
        ];
    }

    public static function dispatch(): void
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        $routes = self::$routes[$method] ?? [];

        foreach ($routes as $route => $data) {
            // convert {param} to regex
            $pattern = '#^' . preg_replace('#\{[^}]+\}#', '([^/]+)', $route) . '$#';
            if (preg_match($pattern, $uri, $matches)) {
                array_shift($matches);

                // run middleware
                foreach ($data['middleware'] as $middlewareClass) {
                    $mw = new $middlewareClass();
                    if (method_exists($mw, 'handle')) {
                        $mw->handle();
                    }
                }

                // dispatch action
                $action = $data['action'];
                if (is_array($action)) {
                    [$class, $methodName] = $action;
                    $controller = new $class();
                    call_user_func_array([$controller, $methodName], $matches);
                } elseif (is_callable($action)) {
                    call_user_func_array($action, $matches);
                }

                return;
            }
        }

        // no route matched
        if (is_callable(self::$fallback)) {
            call_user_func(self::$fallback);
        } else {
            http_response_code(404);
            include __DIR__ . '/../Views/errors/404.php';
        }
    }
}