<?php
error_reporting(E_ALL);

define('ROOT', preg_replace('/\/\w+\/?$/', '', __DIR__));

include __DIR__ . "/../vendor/autoload.php";

try {

    include __DIR__ . "/../app/config/loader.php";

    include __DIR__ . "/../app/config/services.php";

    $application = new \Phalcon\Mvc\Application();
    $application->setDI($di);

    echo $application->handle()->getContent();

} catch (Phalcon\Exception $e) {
    echo $e->getMessage();
} catch (PDOException $e) {
    echo $e->getMessage();
    $errorMsg = $e->getMessage();
    $errorTrace = $e->getTraceAsString();
    file_put_contents(__DIR__ . '/../logs/exception.log', time() . "\n" . date('d.m.Y H:i:s') . "\n" .$errorMsg . "\n" . $errorTrace . "\n\n", FILE_APPEND | LOCK_EX);
    echo $errorMsg;
} catch (Exception $e) {
    echo $e->getMessage();
    $errorMsg = $e->getMessage();
    $errorTrace = $e->getTraceAsString();
    file_put_contents(__DIR__ . '/../logs/exception.log', time() . "\n" . date('d.m.Y H:i:s') . "\n" .$errorMsg . "\n" . $errorTrace . "\n\n", FILE_APPEND | LOCK_EX);
    echo $errorMsg;
}