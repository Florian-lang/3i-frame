<?php

namespace iFrame\Controller;

use App\EntityManager\EntityManager;
use iFrame\Router\Router;

abstract class AbstractController
{
    protected EntityManager $em;

    public function __construct()
    {
        $this->em = new EntityManager();
        if(session_status() === PHP_SESSION_NONE)
        {
            session_start();
        }
       
    }

    /**
     * @param mixed[] $data
     */
    protected function renderView(string $template, array $data = []): string
    {
        $templatePath = dirname(__DIR__, 2) . '/templates/' . $template;
        return require_once dirname(__DIR__, 2) . '/templates/main.php';
    }

    /**
     * @param array<string> $params
     */
    public function redirectToRoute(string $routeName, array $params = []): string
    {
        $path = Router::generate($routeName);

        if (!empty($params)) {
            $strParams = [];
            foreach ($params as $key => $val) {
                array_push($strParams, urlencode((string) $key) . '=' . urlencode((string) $val));
            }
            $path .= '&' . implode('&', $strParams);
        }

        header("Location: " . $path);

        return "You have been sucessfully redirected";
    }
}
