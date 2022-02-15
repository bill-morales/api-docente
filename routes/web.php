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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(["prefix" => "api"], function() use($router) {
    $router->get("docentes/", ["uses" => "DocentesController@listar"]);
    $router->post("docentes/guardar", ["uses" => "DocentesController@guardar"]);
    $router->get("docentes/user/{user_id}", ["uses" => "DocentesController@docenteByIdUsuario"]);
});
