<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Routing\Router;

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    // Route::get('/{any}', 'DashboardController@index')->where('any', '.*');

 

    // Authentication routes (public)
    Route::prefix('auth')->name('auth.')->group(function () {
        // Route::get('/{any}', 'AuthenticationController@index')->where('any', '.*');

        Route::get('/signin', 'AuthenticationController@signin')->name('signin');
        Route::post('/signin', 'AuthenticationController@signin');
        Route::get('/signup', 'AuthenticationController@signup');
        Route::post('/signup', 'AuthenticationController@signup');
    });

    Route::post('auth/logout', 'AuthenticationController@logout')->name('auth.logout');

    // Management routes
    Route::middleware(['auth', 'only-super-admin'])->group(function () {
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

        // Data Company
        Route::prefix('data-company')->name('data-company.')->group(function () {
            Route::get('/', 'DataCompanyController@index')->name('index');
            Route::get('/create', 'DataCompanyController@create')->name('create');
            Route::get('/edit/{id}', 'DataCompanyController@edit')->name('edit');
            Route::post('/store', 'DataCompanyController@store')->name('store');
            Route::put('/update/{id}', 'DataCompanyController@update')->name('update');
            Route::delete('/delete/{id}', 'DataCompanyController@destroy')->name('destroy');
            Route::get('/show/{id}', 'DataCompanyController@show')->name('show');
        });

        // User Management
        Route::prefix('user-management')->name('user-management.')->group(function () {
            Route::get('/', 'UserManagementController@index')->name('index');
            Route::get('/create', 'UserManagementController@create')->name('create');
            Route::post('/store', 'UserManagementController@store')->name('store');
            // show
            Route::get('/show/{id}', 'UserManagementController@show')->name('show');
            // edit
            Route::get('/edit/{id}', 'UserManagementController@edit')->name('edit');
            // update
            Route::put('/update/{id}', 'UserManagementController@update')->name('update');
            // destroy
            Route::delete('/destroy/{id}', 'UserManagementController@destroy')->name('destroy');
        });

        // Site Management
        Route::prefix('site-management')->name('site-management.')->group(function () {
            Route::get('/', 'SiteManagementController@index')->name('index');
            Route::get('/create', 'SiteManagementController@create')->name('create');
            Route::post('/store', 'SiteManagementController@store')->name('store');
            Route::get('/edit/{id}', 'SiteManagementController@edit')->name('edit');
            Route::put('/update/{id}', 'SiteManagementController@update')->name('update');
            Route::delete('/destroy/{id}', 'SiteManagementController@destroy')->name('destroy');
            // show
            Route::get('/show/{id}', 'SiteManagementController@show')->name('show');
        });
    });

    // Monitoring
    Route::prefix('monitoring')->name('monitoring.')->group(function () {
        Route::get('/', 'MonitoringController@index')->name('index');
        Route::get('/show/{id?}', 'MonitoringController@show')->name('show');
        // site details
        Route::get('/site-details/{id}', 'MonitoringController@siteDetails')->name('site-details');
    });

    Route::get('/', function () {
        // return to dashboard
        return redirect()->route('dashboard.index');
    });
});

Route::get('/super-admin', function () {
    return 'Super Admin';
})->middleware('check-super-admin');


Route::get('/middleware-list', function (Router $router) {
    return $router->getMiddleware();
})->name('middleware-list');