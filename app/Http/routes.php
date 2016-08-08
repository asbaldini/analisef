<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(array('middleware' => 'web'), function(){
    Route::get('/', 'HomeController@index');

    Route::get('login', 'Auth\AuthController@showLoginForm');
    Route::post('login', 'Auth\AuthController@login');
    Route::get('logout', 'Auth\AuthController@logout');

    Route::get('registrar', array('as' => 'user.create', 'uses' => 'UserController@create'));
    Route::post('registrar', array('as' => 'user.store', 'uses' => 'UserController@store'));

    Route::group(array('middleware' => array('auth','valid.user')), function(){
        Route::get('home', array('as' => 'dashboard', 'uses' => 'UserController@dashboard'));

        Route::group(array('prefix' => 'usuario'), function(){
            Route::get('/', array('as' => 'user.index', 'uses' => 'UserController@index'));
            Route::get('{usuario}', array('as' => 'user.show', 'uses' => 'UserController@show'));
            Route::get('{usuario}/editar', array('as' => 'user.edit', 'uses' => 'UserController@edit'));
            Route::put('{usuario}', array('as' => 'user.update', 'uses' => 'UserController@update'));
            Route::delete('{usuario}', array('as' => 'user.destroy', 'uses' => 'UserController@destroy'));
        });

        Route::group(array('prefix' => 'analise'), function(){
            Route::get('/', array('as' => 'analysis.index', 'uses' => 'AnalysisController@index'));
            Route::get('criar', array('as' => 'analysis.create', 'uses' => 'AnalysisController@create'));
            Route::post('', array('as' => 'analysis.create', 'uses' => 'AnalysisController@store'));
            Route::get('{analise}', array('as' => 'analysis.show', 'uses' => 'AnalysisController@show'));
            Route::get('{analise}/editar', array('as' => 'analysis.edit', 'uses' => 'AnalysisController@edit'));
            Route::put('{analise}', array('as' => 'analysis.update', 'uses' => 'AnalysisController@update'));
            Route::delete('{analise}', array('as' => 'analysis.destroy', 'uses' => 'AnalysisController@destroy'));
        });

        Route::group(array('prefix' => 'acao'), function(){
            Route::get('/', array('as' => 'action.index', 'uses' => 'ActionController@index'));
            Route::get('criar', array('as' => 'action.create', 'uses' => 'ActionController@create'));
            Route::post('', array('as' => 'action.create', 'uses' => 'ActionController@store'));
            Route::get('{acao}', array('as' => 'action.show', 'uses' => 'ActionController@show'));
            Route::get('{acao}/editar', array('as' => 'action.edit', 'uses' => 'ActionController@edit'));
            Route::put('{acao}', array('as' => 'action.update', 'uses' => 'ActionController@update'));
            Route::delete('{acao}', array('as' => 'action.destroy', 'uses' => 'ActionController@destroy'));
        });
    });
});