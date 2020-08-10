<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix'=>'api/v1', 'middleware' => ['throttle:20,1','BasicAuth']], function() use($router){
    $router->get('/favorite', 'DrinkController@index');
    $router->get('/availablelimit/{id}/{qty}', 'DrinkController@availableoptions');
});