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

$router->post('/api/login', 'AuthController@login');

$router->group(['prefix' => '/api', 'middleware' => 'auth_api'], function () use ($router) {
    $router->group(['prefix' => 'series'], function () use ($router) {
        $router->get('', 'SeriesController@index');
        $router->post('', 'SeriesController@store');
        $router->get('{id}', 'SeriesController@show');
        $router->put('{id}', 'SeriesController@update');
        $router->delete('{id}', 'SeriesController@destroy');
    });

    $router->group(['prefix' => 'episodios'], function () use ($router) {
        $router->get('', 'EpisodiosController@index');
        $router->post('', 'EpisodiosController@store');
        $router->get('{id}', 'EpisodiosController@show');
        $router->put('{id}', 'EpisodiosController@update');
        $router->delete('{id}', 'EpisodiosController@destroy');
    });

    $router->group(['prefix' => 'users'], function () use ($router) {
        $router->get('', 'UsersController@index');
        $router->post('', 'UsersController@store');
        $router->get('{id}', 'UsersController@show');
        $router->put('{id}', 'UsersController@update');
        $router->delete('{id}', 'UsersController@destroy');
    });
});
