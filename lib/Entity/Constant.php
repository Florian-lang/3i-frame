<?php

namespace iFrame\Entity;

//Obligé de mettre les define + le nom dans une constante sinon phpstan nous bloque
define("URL_IMAGE", $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/assets/images_upload/');
define("ASSET_IMAGE", './assets/images_upload/');

class Constant
{
    public const URL_IMAGE = URL_IMAGE;
    public const ASSET_IMAGE = ASSET_IMAGE;
}
