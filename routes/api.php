<?php

use App\Http\Controllers\API\loginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\siswaController;

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

Route::post('/login', [loginController::class, 'login']);
Route::post('/logout', [loginController::class, 'logout']);

Route::middleware(['auth:sanctum', 'role:sarpra'])->group(function () {
    Route::get('/getSiswa', [siswaController::class, 'getSiswa']);
    Route::get('/getSiswa/{id}', [siswaController::class, 'selectSiswa']);
    Route::post('/createSiswa', [siswaController::class, 'createSiswa']);
    Route::put('/updateSiswa/{id}', [siswaController::class, 'updateSiswa']);
    Route::delete('/deleteSiswa/{id}', [siswaController::class, 'deleteSiswa']);
});

Route::middleware(['auth:sanctum', 'role:karyawan'])->group(function () {
});

Route::middleware(['auth:sanctum', 'role:walikelas'])->group(function () {
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
