<?php

use App\Http\Controllers\ApiLogsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteManagementController;
use App\Http\Controllers\AuthenticationController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Respionse hello world
Route::get('get-topic', [SiteManagementController::class, 'getTopic']);

// API LOG
Route::post('api-log', [ApiLogsController::class, 'store']);

Route::get('monitoring-data', [ApiLogsController::class, 'getMonitoringData']);

// Get Site By Company Id
Route::get('/get-site-by-company-id/{companyId}', [SiteManagementController::class, 'getSitesByCompanyId']);

// Login
Route::post('login', action: [AuthenticationController::class, 'loginMobile']);
