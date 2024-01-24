<?php

namespace iFrame\Router;

class Router
{
    /**
     * @var array<array<string, string>>
     */
    private array $routes;

    /**
     * @var array<int, string>
     */
    private array $routePaths;

    private string $requestedPath;

    public function __construct()
    {
        $routesFile = file_get_contents(dirname(__DIR__) . '/../config/routes.json');

        if(!is_string($routesFile)) {
            throw new \Exception('Routes file not found');
        }

        $routes = json_decode($routesFile, true);

        if(!is_array($routes)) {
            throw new \Exception('Routes file is not valid');
        }

        $this->routes = $routes;
        $this->routePaths = array_keys($this->routes);
        $this->requestedPath = isset($_GET['path']) ? $_GET['path'] : '/';
        $this->parseRoutes();
    }

    private function parseRoutes(): void
    {
        $explodedRequestedPath = $this->explodePath($this->requestedPath);
        $params = [];

        foreach ($this->routePaths as $routePath) {

            $foundMatch = true;

            $explodedRoutePaths = $this->explodePath($routePath);

            if (count($explodedRoutePaths) === count($explodedRequestedPath)) {

                foreach ($explodedRequestedPath as $key => $requestedPathPart) {
                    $candidatePathPart = $explodedRoutePaths[$key];

                    if ($this->isParam($candidatePathPart)) {
                        $params[substr($candidatePathPart, 1, -1)] = $requestedPathPart;
                    } elseif ($candidatePathPart !== $requestedPathPart) {
                        $foundMatch = false;
                        break;
                    }
                }

                if ($foundMatch) {
                    $route = $this->routes[$routePath];

                    if(is_array($route)) {
                        break;
                    }
                }
            }
        }

        if (isset($route) && is_array($route)) {
            $controller = new $route['controller']();
            $controller->{$route['method']}(...$params);
        }

    }

    /**
     * @return array<string>
     */
    private function explodePath(string $path): array
    {
        return explode("/", rtrim(ltrim($path, '/'), '/'));
    }

    private function isParam(string $candidatePathPart): bool
    {
        return str_contains($candidatePathPart, '{') && str_contains($candidatePathPart, '}');
    }

}
