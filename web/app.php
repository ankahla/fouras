<?php

use Symfony\Component\Debug\Debug;
use Symfony\Component\HttpFoundation\Request;

require __DIR__.'/../app/autoload.php';

if (getenv('APP_DEBUG') === 'true') {
    Debug::enable();
}

$kernel = new kernel(getenv('APP_ENV'), getenv('APP_DEBUG'));

// When using the HttpCache, you need to call the method in your front controller instead of relying on the configuration parameter
//Request::enableHttpMethodParameterOverride();
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
