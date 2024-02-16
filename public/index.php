<?php

use iFrame\Entity\CsrfToken;
use iFrame\Router\Router;

require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once dirname(__DIR__) . '/lib/autoload.php';

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

if(session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(
    session_status() === PHP_SESSION_ACTIVE
    && !isset($_SESSION['csrf_token'])
) {
    $_SESSION['csrf_token'] = (new CsrfToken())->generateCsrfToken();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'
    && (
        !isset($_POST['csrf_token'])
        || !(new CsrfToken())->isCsrfTokenValid($_POST['csrf_token'])
    )
) {
    throw new \RuntimeException('CSRF token invalid');
}

new Router();
