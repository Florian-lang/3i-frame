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
    }

    /**
     * @param mixed[] $data
     */
    protected function renderView(string $template, array $data = []): string
    {
        $templatePath = dirname(__DIR__, 2) . '/templates/' . $template;
        if($template === "auth/register.php" || $template ===  "auth/login.php")
        {
            return require_once $templatePath;

        }
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
