<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    // Route::get('/{any}', 'DashboardController@index')->where('any', '.*');

    // Authentication
    Route::prefix('auth')->group(function () {
        // Route::get('/{any}', 'AuthenticationController@index')->where('any', '.*');

        Route::get('/signin', 'AuthenticationController@signin');
        // Route::post('/signin', 'AuthenticationController@signin');
        Route::get('/signup', 'AuthenticationController@signup');
        Route::post('/signup', 'AuthenticationController@signup');
    });

    // Dashboard
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        // Route::get('/{any}', 'DashboardController@index')->where('any', '.*');

        Route::get('/', 'DashboardController@index')->name('index');

        Route::get('/user-management', 'UserController@index')->name('users.index');

        Route::get('/users/create', 'UserController@create')->name('users.create');

        Route::post('/users', 'UserController@store')->name('users.store');

        Route::get('/users/edit/{id}', 'UserController@edit')->name('users.edit');

        Route::post('/users/edit/{id}', 'UserController@update')->name('users.update');

        Route::get('/users/delete/{id}', 'UserController@delete')->name('users.delete');

        Route::delete('/users/delete/{id}', 'UserController@destroy')->name('users.destroy');

        Route::get('/users/search', 'UserController@search')->name('users.search');

        // Route::resource('users', UserController::class);

        Route::get('/profile', 'ProfileController@index')->name('profile.index');

        Route::get('/settings', 'ProfileController@settings')->name('settings.index');

        Route::get('/users/export', [UserController::class, 'export'])->name('users.export');
    });

    Route::get('/', function () {
        return view('welcome');
    });
});
