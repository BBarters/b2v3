<?php


Route::get('/', function () {
    return view('login');
});

Route::post('/login','LoginAndRegistrationController@login');

Route::get('/home','LoginAndRegistrationController@home');


//Route::resource('/login','LoginAndRegistrationController');
Route::get('/test','TestController@getSome');


Route::post('signup','LoginAndRegistrationController@signup');