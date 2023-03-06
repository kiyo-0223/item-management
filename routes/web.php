<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TypeController;
use App\Models\Item;
use App\Models\Type;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('items')->group(function () {
    Route::get('/', [App\Http\Controllers\ItemController::class, 'index'])->name('index');
    Route::get('/add', [App\Http\Controllers\ItemController::class, 'add']);
    Route::post('/add', [App\Http\Controllers\ItemController::class, 'add']);
});

Route::prefix('items')->group(function () {
    Route::get('/edit/{id}', [ItemController::class, 'item'])->name('item');
    Route::post('/edit/{id}', [ItemController::class, 'itemEdit'])->name('item.edit');
    Route::post('/delete/{id}', [ItemController::class, 'itemDelete'])->name('item.delete');
});

Route::prefix('types')->group(function () {
    // 管理画面へ
    Route::get('/management', [TypeController::class, 'management'])->name('management');
    // 種別一覧表示
    Route::get('/type', [TypeController::class, 'type'])->name('type');
    Route::post('/type', [TypeController::class, 'typeAdd']);
    Route::get('/type_edit}', [ItemController::class, 'typeEdit'])->name('type.edit');
    // Route::post('/type_edit/{id}', [ItemController::class, 'typeEdit'])->name('item.edit');
    // Route::post('/type_delete/{id}', [ItemController::class, 'typeDelete'])->name('item.delete');

    Route::get('/role', [TypeController::class, 'roleEdit']);
});
