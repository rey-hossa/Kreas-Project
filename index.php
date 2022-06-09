<?php

include_once 'core/Router.php';
include_once 'core/Request.php';

$fileContent = file(__DIR__.'/.env');
foreach($fileContent as $envVar){
       putenv(trim($envVar));
     
     } 

$routes = include_once 'routes.php';

$request = new Request;
$request->decodeHttpRequest();

$router = new Router;
$router->load($routes);
$router->direct($request->getPath(), $request->getMethod());


