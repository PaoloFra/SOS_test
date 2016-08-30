<?php

use Phalcon\Config\Adapter\Ini as IniConfig;

//-------------------------

define('ENVIRONMENT', 'LOCAL');

$loader = new \Phalcon\Loader();
switch (ENVIRONMENT) {
    case 'PRODUCTION':
        $file = 'config';
        break;
    case 'LOCAL':
        $file = 'config.loc';
        break;
    default:
        $file = 'config.dev';
}
$config = new IniConfig(__DIR__ . "/$file.ini");
/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs(
    array(
        __DIR__ . $config->application->controllersDir,
        __DIR__ . $config->application->viewsDir,
        __DIR__ . $config->application->servicesDir,
        __DIR__ . $config->application->modelsDir,
    )
)->register();

