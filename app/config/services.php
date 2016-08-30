<?php

use Phalcon\DI\FactoryDefault;
use Phalcon\Config\Adapter\Ini as IniConfig;
use Phalcon\Http\Response;
use Phalcon\Mvc\View;

use Phalcon\Cache\Backend\File as BackFile;
use Phalcon\Cache\Frontend\Data as FrontData;
use Phalcon\Mvc\Model\Manager as ModelsManager;

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();

$di->setShared('modelsManager', function() {
    return new ModelsManager();
});

$di->setShared('config', function() use ($config) {
    return $config;
});

$di->set('dispatcher', function () use ($di) {

    $eventsManager = $di->getShared('eventsManager');

    $dispatcher = new Phalcon\Mvc\Dispatcher();
    $dispatcher->setEventsManager($eventsManager);

    return $dispatcher;
});

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->set('url', function () use ($di) {
    $url = new \Phalcon\Mvc\Url();
    // $url->setBaseUri($config->application->baseUri);
    $url->setBaseUri('http://'.$_SERVER['HTTP_HOST'].'/');
    return $url;
});


$di->set('view', function () use ($di) {
    $config = $di->getShared('config');
    $eventsManager = $di->getShared('eventsManager');

    $view = new \Phalcon\Mvc\View();

    $view->setViewsDir(__DIR__ . $config->application->viewsDir);

    $view->registerEngines(array(
        ".volt" => 'volt'
    ));

    $view->setEventsManager($eventsManager);
    return $view;
});

$di->set('simple_view', function() use ($di) {
    $config = $di->getShared('config');

    $view = new Phalcon\Mvc\View\Simple();

    $view->setViewsDir(__DIR__ . $config->application->viewsDir);
    $view->registerEngines(array(
        ".volt" => 'volt'
    ));

    return $view;

}, true);


/**
 * Database connection is created based in the parameters defined in the configuration file
 */

$di->set('db', function () use ($di) {
    $config = $di->getShared('config');
    $dbAdapter = '\Phalcon\Db\Adapter\Pdo\\'.$config->database->adapter;
    return new $dbAdapter(array(
        "host" => $config->database->host,
        "port" => $config->database->port,
        "username" => $config->database->username,
        "password" => $config->database->password,
        "dbname" => $config->database->dbname,
        'options' => [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_PERSISTENT => false,
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET names utf8'
        ]
    ));
});


/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->set('modelsMetadata', function () use ($di) {
    $config = $di->getShared('config');
    if (isset($config->models->metadata)) {
        $metaDataConfig = $config->models->metadata;
        $metadataAdapter = 'Phalcon\Mvc\Model\Metadata\\'.$metaDataConfig->adapter;
        return new $metadataAdapter();
    }
    return new Phalcon\Mvc\Model\Metadata\Memory();
});

/**
 * Start the session the first time some component request the session service
 */
$di->setShared('session', function () {
    ini_set('session.gc_maxlifetime', 3600 * 24);
    ini_set('session.entropy_length', 32);
    $session = new Phalcon\Session\Adapter\Files([
        'lifetime' => 3600 * 24
    ]);
    $session->start();
    return $session;
});

/**
 * Register the flash service with custom CSS classes
 */
$di->set('flash', function () {
    return new Phalcon\Flash\Session(array(
        'error' => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice' => 'alert alert-info',
        'warning' => 'alert alert-warning'
    ));
});

/**
 * Setting up volt
 */
$di->set('volt', function ($view, $di) {

    $config = $di->getShared('config');
    $volt = new \Phalcon\Mvc\View\Engine\Volt($view, $di);

    $volt->setOptions(array(
        "compiledPath" => '../cache/volt/',
        'compileAlways' => false
    ));

    if ($config->application->debugMode) {
        array_map('unlink', glob($config->application->cacheDir . 'volt/*.php'));
        $volt->setOptions(array(
            'compileAlways' => true,
        ));
    }

    $compiler = $volt->getCompiler();
    $compiler->addFunction('number_format', 'number_format');
    $compiler->addFunction('strtotime', 'strtotime');
    $compiler->addFunction('date', 'date');
    $compiler->addFunction('round', 'round');
    $compiler->addFunction('count', 'count');
    $compiler->addFunction('array_sum', 'array_sum');
    $compiler->addFunction('htmlspecialchars_decode', 'htmlspecialchars_decode');
    $compiler->addFunction('capitalize', 'lcfirst');

    $compiler->addFunction('strip_spaces', function($intlvar) {
        return 'str_replace(" ", "", '.$intlvar.')';
    });
    $compiler->addFunction('strip_quotes_commas', function($intlvar) {
        return 'str_replace(["' . '&quot;' . '", "' . '&apos;' . '", "' . '\"' . '", "' . '(' . '", "' . ')' . '", "' . "'" . '","' . ',' . '"], "", '.$intlvar.')';
    });
    //--------------------------------
    return $volt;
}, true);

/**
 * Register a user component
 */

$di->set(
    'router',
    function () {
        return include __DIR__.'/routes.php';
    }
);

//***************************************

$di->setShared('modelsCache', function () {

    $frontCache = new FrontData(
        array(
            "lifetime" => 3600
        )
    );

    $cache = new BackFile(
        $frontCache,
        array(
            "cacheDir" => "../cache/"
        )
    );

    return $cache;
});

//---------------------------------------------



