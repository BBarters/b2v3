<?php


Route::get('/', function () {
    return view('login');
});

Route::post('/login','LoginAndRegistrationController@login');

Route::get('/home','LoginAndRegistrationController@home');


//Route::resource('/login','LoginAndRegistrationController');
Route::get('/test','TestController@getSome');

Route::get('signup','LoginAndRegistrationController@signup');

Route::get('/signupView',function (){
      return view('signup');
});

Route::get('/testing','LoginAndRegistrationController@testing');