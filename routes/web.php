<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    if(Auth::check()){
        return \Redirect::to('home');
    }else{
        return view('auth/login');
    }

});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/create_event', 'HomeController@getCreateEvent');

Route::post('/create_event', 'HomeController@postCreateEvent');

Route::get('/update_event/{id}', 'HomeController@getUpdateEvent');

Route::post('/update_event/{id}', 'HomeController@postUpdateEvent');

Route::get('/update_events', 'HomeController@getEventsForUpdate');

Route::get('/events', 'HomeController@getEvents');

Route::get('/event/{id}', 'HomeController@getEvent');

Route::get('/user_events', 'HomeController@getUserEvents');

Route::get('/attend/{id}', 'HomeController@attendEvent');

