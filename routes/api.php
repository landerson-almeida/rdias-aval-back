<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'App\RDias\Actions'], function() {
    Route::get('user', UsersListAction::class);
    Route::post('user', UserCreateAction::class);
    Route::get('user/{id}', UserListAction::class);
    Route::match(['PUT', 'PATCH'], 'user/{id}', UserUpdateAction::class);
    Route::delete('user/{id}', UserDeleteAction::class);
});
