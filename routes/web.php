<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/activity-groups', 'ActivityController@index');
$router->post('/activity-groups', 'ActivityController@store');
$router->get('/activity-groups/{id}', 'ActivityController@show');
$router->patch('/activity-groups/{id}', 'ActivityController@update');
$router->delete('/activity-groups/{id}', 'ActivityController@destroy');

$router->get('/todo-items', 'ToDoController@index');
$router->post('/todo-items', 'ToDoController@store');
$router->get('/todo-items/{id}', 'ToDoController@show');
$router->patch('/todo-items/{id}', 'ToDoController@update');
$router->delete('/todo-items/{id}', 'ToDoController@destroy');
