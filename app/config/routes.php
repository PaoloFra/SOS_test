<?php

$router = new \Phalcon\Mvc\Router(/*false*/);
$router->removeExtraSlashes(true);
//$router->setDefaultNamespace('Controllers');
//$router->add('/{controller}', ['action' => 'index'])->setName('controller');
//$router->add('/{controller}/{action}')->setName('controller/action');
//$router->add('/{controller}/{action}/{params}')->setName('controller/action/params');

return $router;