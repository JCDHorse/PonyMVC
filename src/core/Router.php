<?php

namespace core;

use controllers\ControllerResponse;
use controllers\ErrorController;

class Router
{
    private array $routes = [];

    public function __construct(
        private readonly ErrorController $errorController
    ) {}

    public function addRoute(string $method, string $path, callable $handler): void
    {
        $this->routes[$method][$path] = $handler;
    }

    public function dispatch(string $method, string $url): ControllerResponse
    {
        $method = strtoupper($method);
        $url = '/' . trim($url, '/');

        if (!isset($this->routes[$method])) {
            return $this->errorController->getError(405, 'Method not allowed');
        }

        foreach ($this->routes[$method] as $path => $handler) {
            // Replace path like /thing/{id} by @/thing/([^/]+)$@
            $pattern = "@^" . preg_replace("@\{(\w+)\}@", "([^/]+)", $path) . "$@";

            if (preg_match($pattern, $url, $matches)) {
                array_shift($matches);
                $response = call_user_func_array($handler, $matches);
                if ($response->getResponseCode() !== 200) {
                    if ($response->getResponseCode() >= 300 && $response->getResponseCode() < 400) {
                        header("Location: {$response->getResponse()}");
                        return $response;
                    }
                    return $this->errorController->getError(
                        $response->getResponseCode(),
                        $response->getResponse()
                    );
                }
                return $response;
            }
        }
        return $this->errorController->getError(404, 'Not found');
    }

}