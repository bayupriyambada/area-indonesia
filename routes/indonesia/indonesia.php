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

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->group(['prefix' => 'indonesia'], function () use ($router) {
        // kepulauan
        $router->group(['prefix' => 'cari'], function () use ($router) {
            $router->group(['prefix' => 'kepulauan'], function () use (
                $router
            ) {
                $router->get(
                    '/',
                    'indonesia\cari\CariIndonesiaController@aksiCariKepulauan'
                );
            });

            // provinsi
            $router->group(['prefix' => 'provinsi'], function () use ($router) {
                $router->get('/', 'indonesia\ProvinsiController@getSearchData');
            });

            // kabupaten
            $router->group(['prefix' => 'kabupaten'], function () use (
                $router
            ) {
                $router->get('/', 'indonesia\KabupatenController@getAllData');
                $router->get(
                    '/',
                    'indonesia\KabupatenController@getSearchData'
                );
            });
        });
    });
});
