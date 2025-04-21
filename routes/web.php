<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('login');
});
Route::get('/login-success', function () {
    return view('login_success');
});
Route::post('/login', [App\Http\Controllers\LoginController::class, 'login'])->name('login');
// routes/web.php
use App\Http\Controllers\DropdownController;

Route::get('/dependent-dropdown', [DropdownController::class, 'index']);
Route::get('/get-districts/{division}', [DropdownController::class, 'getDistricts']);
Route::get('/get-upazilas/{district}', [DropdownController::class, 'getUpazilas']);
Route::post('/save-location', [DropdownController::class, 'saveLocation']);
