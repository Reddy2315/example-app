<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalculatorController;

use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/calc/{id}', [CalculatorController::class, 'api']);

Route::get('/users', [UserController::class, 'index'])->name('user,index');
Route::get('/users/{id}', [UserController::class, 'show'])->name('user,show');
// update result use put
Route::put('/users/{id}', [UserController::class, 'update'])->name('user,update');
//savedata 
Route::put('/users/{id}', [UserController::class, 'savedata'])->name('user,savedata');
//delete
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user,destroy');
