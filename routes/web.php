<?php

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
$router->get('/token-check', 'AuthController@tokenCheck');
$router->post('/login', 'AuthController@login');
$router->post('/register', 'AuthController@register');
$router->post('/forgot-password', 'AuthController@forgotPassword');
$router->get('/reset-password/{token}', 'AuthController@check');
$router->put('/reset-password', 'AuthController@reset');


$router->group(['middleware' => 'auth'], function () use ($router) {
    
    //emapta 
    $router->get('/agile', 'AgileController@index');
    $router->post('/agile', 'AgileController@store');
    $router->delete('/agile/{id}', 'AgileController@destroy');
    $router->put('/agile/{agile}', 'AgileController@update');

    /** Users Management Endpoints */ 
    $router->get('/users', 'UserController@index');
    $router->post('/users', 'UserController@store');
    $router->put('/users/{user}', 'UserController@update');
    $router->delete('/users/{user}', 'UserController@destroy');
});

/**
 * For Testing Only
 */

$router->post('/dinstar', 'DinstarController@sendSMS');
$router->get('/jobs/ticket', 'TicketJobController@index');
$router->get('/dinstar', 'DinstarController@getSMS');
