<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CreditoSectorController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//LISTAR TODOS
Route::get('/sectores', [CreditoSectorController::class, 'getAll']);

//LISTAR ESPECIFICAMENTE
Route::get('/sectores/{id}', [CreditoSectorController::class, 'getItem']);

//INSERTAR
Route::post('/sectores', [CreditoSectorController::class, 'store']);

//ACTUALIZAR
Route::put('/sectores/{id}', [CreditoSectorController::class, 'updatePut']);

//ACTUALIZAR
Route::patch('/sectores/{id}', [CreditoSectorController::class, 'updatePatch']);

//BORRAR
Route::delete('/sectores/{id}', [CreditoSectorController::class, 'delete']);
