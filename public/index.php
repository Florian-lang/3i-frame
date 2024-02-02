<?php

use iFrame\Router\Router;

require_once dirname(__DIR__) . '/lib/autoload.php';
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}

new Router();
