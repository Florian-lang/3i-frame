<?php

namespace iFrame\Controller;

use App\EntityManager\EntityManager;
use iFrame\Entity\RedirectResponse;
use iFrame\Entity\Response;
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
    protected function renderView(string $template, array $data = []): Response
    {
        $templatePath = dirname(__DIR__, 2) . '/templates/' . $template;
        ob_start();

        if($template === "auth/register.php" || $template ===  "auth/login.php") {
            require_once $templatePath;
        } else {
            require_once dirname(__DIR__, 2) . '/templates/main.php';
        }

        $content = ob_get_clean();

        if(!$content) {
            throw new \Exception('Template not found');
        }

        return new Response($content);
    }

    /**
     * @param array<string> $params
     */
    public function redirectToRoute(string $routeName, array $params = []): RedirectResponse
    {
        $path = Router::generate($routeName);

        if (!empty($params)) {
            $strParams = [];
            foreach ($params as $key => $val) {
                array_push($strParams, urlencode((string) $key) . '=' . urlencode((string) $val));
            }
            $path .= '&' . implode('&', $strParams);
        }

        return new RedirectResponse($path);
    }
}
