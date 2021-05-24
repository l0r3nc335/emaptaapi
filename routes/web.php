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
    $router->get('/declarations/download', 'DeclarationController@downloadExcel');
    $router->get('/declarations', 'DeclarationController@index');
    $router->put('/change-password', 'AuthController@changePassword');
    $router->post('/logout', 'AuthController@logout');

    $router->get('/autofill', 'AutofillController@show');
    $router->put('/autofill', 'AutofillController@update');

    /** Project Management Endpoints */
    $router->get('/projects', 'ProjectController@index');
    $router->get('/active-projects', 'ProjectController@activeProjects');
    $router->post('/projects', 'ProjectController@store');
    $router->get('/projects/{project}', 'ProjectController@show');
    $router->put('/projects/{project}', 'ProjectController@update');
    $router->delete('/projects/{project}', 'ProjectController@destroy');

    /** Ticket Management Endpoints */
    $router->get('/tickets', 'TicketController@index');
    $router->put('/tickets/{ticket}', 'TicketController@update');
    $router->get('/tickets/{ticket}', 'TicketController@show');

    $router->get('/projects-report', 'TicketController@projectsReport');
    $router->get('/project-year-month', 'TicketController@projectsReportYearMonth');
    $router->get('/projects-report/download', 'TicketController@ticketReportDownload');

    

    /** SMS Blast Endpoints */
    $router->get('/sms-blasts', 'SmsBlastController@index');
    $router->post('/sms-blasts', 'SmsBlastController@store');
    $router->get('/sms-blasts/{smsBlast}', 'SmsBlastController@show');
    $router->put('/sms-blasts/{smsBlast}', 'SmsBlastController@update');
    $router->delete('/sms-blasts/{smsBlast}', 'SmsBlastController@destroy');

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
