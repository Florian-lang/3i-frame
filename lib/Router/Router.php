<?php

namespace iFrame\Router;

use App\Controller\MainController;
use Exception;

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

        //On regarde si l'url existe bien, sinon on retourne 404
        $this->requestedPath = '/';
        if(isset($_SERVER['REQUEST_URI'])) {
            $urlExist = false;
            //Enlever les potentiels GET dans l'URI
            $arrayUri = explode("?",$_SERVER['REQUEST_URI']);
            $requestUri = $arrayUri[0];
            foreach ($this->routePaths as $route) {
        
                if($route === $requestUri) {
                    $this->requestedPath =  $requestUri;

                    if(isset($_SESSION['login'])
                        && (
                            $requestUri === Router::generate('app_login')
                            || $requestUri === Router::generate('app_register')
                        )
                    ) {
                        $redirection = new MainController();
                        $redirection->redirectToRoute('app_home');
                    }

                    $urlExist = true;
                    break;

                }
            }
         
            if($urlExist === false) {
                $this->requestedPath = '/notFound';
            }

        }

        $this->parseRoutes();
    }

    private function parseRoutes(): void
    {
        $explodedRequestedPath = $this->explodePath($this->requestedPath);

        foreach ($this->routePaths as $routePath) {
            $foundMatch = true;
            $explodedRoutePaths = $this->explodePath($routePath);

            if (count($explodedRoutePaths) === count($explodedRequestedPath)) {

                foreach ($explodedRequestedPath as $key => $requestedPathPart) {
                    $candidatePathPart = $explodedRoutePaths[$key];

                    if ($candidatePathPart !== $requestedPathPart) {
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
            $controller->{$route['method']}();
        }

    }

    /**
     * @return array<string>
     */
    private function explodePath(string $path): array
    {
        return explode("/", rtrim(ltrim($path, '/'), '/'));
    }

    /**
     * @param array<string, mixed> $params
     */
    public static function generate(?string $routeName = null, array $params = []): string
    {

        $routesFile = file_get_contents(dirname(__DIR__) . '/../config/routes.json');
        if($routesFile === false) {
            throw new Exception("Fichier non trouvé");
        }

        /**
         * @var array<string, array<string>>
         */
        $data = json_decode($routesFile, true);

        if($routeName === null) {
            return '/';
        }

        foreach ($data as $url => $parameters) {
            if ($parameters["name"] === $routeName) {

                if(!empty($params)) {
                    $url .= '?';
                    foreach ($params as $key => $value) {
                        $url .= $key . '=' . $value . '&';
                    }
                }

                return $url;
            }
        }

        return '/notFound';
    }
}
