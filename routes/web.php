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

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->group(['prefix' => 'indonesia'], function () use ($router) {
        // kepulauan
        $router->group(['prefix' => 'kepulauan'], function () use ($router) {
            $router->get('/', 'indonesia\KepulauanController@getAllData');
            $router->get('/q', 'indonesia\KepulauanController@getSearchData');
            $router->post(
                '/simpan',
                'indonesia\KepulauanController@getPostData'
            );
        });
        // provinsi
        $router->group(['prefix' => 'provinsi'], function () use ($router) {
            $router->get('/', 'indonesia\ProvinsiController@getAllData');
            $router->get('/q', 'indonesia\ProvinsiController@getSearchData');
            $router->post(
                '/simpan',
                'indonesia\ProvinsiController@getPostData'
            );
        });

        // kabupaten
        $router->group(['prefix' => 'kabupaten'], function () use ($router) {
            $router->get('/', 'indonesia\KabupatenController@getAllData');
            $router->get('/q', 'indonesia\KabupatenController@getSearchData');
            $router->post(
                '/simpan',
                'indonesia\KabupatenController@getPostData'
            );
        });
    });
});

require 'indonesia/indonesia.php';
