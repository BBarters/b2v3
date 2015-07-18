<?php


Route::get('/', function () {
    return view('login');
});

Route::post('/login','LoginAndRegistrationController@login');

Route::get('/home','LoginAndRegistrationController@home');

Route::get('/signup',function (){
    return view('signup');
});
//Route::resource('/login','LoginAndRegistrationController');