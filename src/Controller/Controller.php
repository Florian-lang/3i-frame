<?php
namespace App\Controller;

class Controller {

    //Retourne une vue
    protected function view(string $template, array $data = []): string {
		$templatePath = dirname(__DIR__, 2) . '/templates/' . $template;
		return require_once dirname(__DIR__, 2) . '/templates/layouts.php';
	}

    //Redirige
    protected function redirect(string $path, array $params = []): void {
		$uri = $_SERVER['SCRIPT_NAME'] . "?path=" . $path;

		if (!empty($params)) {
			$strParams = [];
			foreach ($params as $key => $val) {
				array_push($strParams, urlencode((string) $key) . '=' . urlencode((string) $val));
			}
			$uri .= '&' . implode('&', $strParams);
		}

		header("Location: " . $uri);
		die;
	}
}