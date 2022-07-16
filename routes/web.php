<?php

use Illuminate\Support\Facades\Route;


Route::group(['middleware'=>'guest'], function(){ //yang berada didalam group ini hanya untuk yang belum login saja
    Route::get('/login', 'App\Http\Controllers\GeneralController@login')->name('login');
    Route::post('/dologin', 'App\Http\Controllers\GeneralController@dologin');
});


Route::group(['middleware'=>'auth'], function(){ //yang berada didalam group ini hanyta untuk yang sudah login
    Route::get('/', 'App\Http\Controllers\GeneralController@home')->name('home');

    Route::post('/getcity', 'App\Http\Controllers\GeneralController@getcity');
    Route::post('/getdistrict', 'App\Http\Controllers\GeneralController@getdistrict');
    Route::post('/getsubdistrict', 'App\Http\Controllers\GeneralController@getsubdistrict');
    

    Route::prefix('class')->group(function () {
        Route::get('/', 'App\Http\Controllers\ClassController@index');
        Route::post('/gridview', 'App\Http\Controllers\ClassController@gridview');
        Route::get('/create', 'App\Http\Controllers\ClassController@create');
        Route::post('/store', 'App\Http\Controllers\ClassController@store');
        Route::get('/edit/{id}', 'App\Http\Controllers\ClassController@edit');
        Route::post('/update/{id}/{isaktif}', 'App\Http\Controllers\ClassController@update');
        Route::get('/delete/{id}', 'App\Http\Controllers\ClassController@destroy');
    });


    Route::prefix('employee')->group(function () {
        Route::get('/', 'App\Http\Controllers\EmployeeController@index');
        Route::post('/gridview', 'App\Http\Controllers\EmployeeController@gridview');
        Route::get('/create', 'App\Http\Controllers\EmployeeController@create');
        Route::post('/store', 'App\Http\Controllers\EmployeeController@store');
        Route::get('/edit/{id}', 'App\Http\Controllers\EmployeeController@edit');
        Route::get('/show/{id}/{detail}', 'App\Http\Controllers\EmployeeController@edit');
        Route::post('/update/{id}/{isaktif}', 'App\Http\Controllers\EmployeeController@update');
        Route::get('/delete/{id}', 'App\Http\Controllers\EmployeeController@destroy');
    });

    Route::prefix('parent')->group(function () {
        Route::get('/', 'App\Http\Controllers\ParentController@index');
        Route::get('/create', 'App\Http\Controllers\ParentController@create');
        Route::post('/store', 'App\Http\Controllers\ParentController@store');
    });

    Route::prefix('student')->group(function () {
        Route::get('/', 'App\Http\Controllers\StudentController@index');
        Route::post('/gridview', 'App\Http\Controllers\StudentController@gridview');
        Route::get('/create', 'App\Http\Controllers\StudentController@create');
        Route::post('/store/{id}/{isaktif}', 'App\Http\Controllers\StudentController@store');
        Route::get('/edit/{id}', 'App\Http\Controllers\StudentController@create');
        Route::get('/show/{id}/{detail}', 'App\Http\Controllers\StudentController@create');
        Route::get('/delete/{id}', 'App\Http\Controllers\StudentController@destroy');
    });


    Route::get('/dologout', 'App\Http\Controllers\GeneralController@dologout');

});

Route::get('/user', 'App\Http\Controllers\UserController@home');

