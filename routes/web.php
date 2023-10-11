<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/product_informants',[App\Http\Controllers\ProductSearchFormController::class, 'productInformantsPage'])->name('prodInts');
Route::get('/product_register',[App\Http\Controllers\ProductSearchFormController::class, 'productRegisterForm'])->name('new');
Route::post('/product_register',[App\Http\Controllers\ProductSearchFormController::class, 'productRegisterForm'])->name('new');
Route::get('/product_specific',[App\Http\Controllers\ProductSearchFormController::class, 'productSpecificPage'])->name('prodSp');
Route::get('/product_informant_edit',[App\Http\Controllers\ProductSearchFormController::class, 'productInformantEditForm'])->name('prodIntEd');
Route::post('/product_informant_edit',[App\Http\Controllers\ProductSearchFormController::class, 'productInformantEditForm'])->name('prodIntEd');
Auth::routes();
