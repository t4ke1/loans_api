<?php

declare(strict_types=1);

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

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('loans', 'LoanController@create');
    $router->get('loans/{id}', 'LoanController@show');
    $router->put('loans/{id}', 'LoanController@update');
    $router->delete('loans/{id}', 'LoanController@delete');
    $router->get('loans', 'LoanController@loanList');
});
