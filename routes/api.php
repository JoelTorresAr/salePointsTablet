<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/


Route::group(['namespace' => 'Tablet'], function () {

    Route::group(['prefix' => 'auth',], function ($router) {
        Route::get('mozo', 'PinAuthController@login');
    });

    Route::group(['middleware' => ['auth:api'], 'prefix' => 'tablet'], function ($router) {
        Route::post('mesas', 'CommandController@mesas');
        Route::post('comanda/nueva', 'CommandController@nuevaComanda');
        Route::post('comanda/item/agregar', 'CommandController@agregarItem');
        Route::post('comanda/item/listar', 'CommandController@listarItemsMesa');
        Route::post('comanda/item/alterar', 'CommandController@alterarLista');
    });
});
