<?php
// DIC configuration
$container = $app->getContainer();

//Override the default Not Found Handler
$container['notFoundHandler'] = function ($c) {
  return function ($request, $response) use ($c) {
    return $c['response']
      ->withStatus(404)
      ->withHeader('Content-Type', 'text/html')
      ->write('404 Dude!');
  };
};

$container['notAllowedHandler'] = function ($c) {
  return function ($request, $response) use ($c) {
    return $c['response']
      ->withStatus(404)
      ->withHeader('Content-Type', 'text/html')
      ->write('Dude! this page is Forbidden');
  };
};


/*
  Controller

$container[App\Controller\BlogController::class] = function ($c) {
  return new App\Controller\BlogController($c->logger);
};
*/
