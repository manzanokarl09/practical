<?php



$router->resources([
   'samples' => 'SampleController',
]);

$router->group(['prefix' => "auth"], function ($router) {
    $router->post('login', 'AuthUserController@login');
    $router->post('logout', 'AuthUserController@logout');
    $router->post('refresh-token', 'AuthUserController@refresh');
});

$router->group(['middleware' => ['jwt.verify']], function($router) {
    $router->post('order', 'OrderController@store');
});
  
$router->post('register', 'RegisterController@register');
