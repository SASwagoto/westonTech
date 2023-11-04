<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/home', [HomeController::class, 'index'])->name('dashboard');

    Route::get('/language/{lang}', [LangController::class, 'index'])->name('langChange');

    Route::prefix('employee')->group(function () {
        Route::get('list', [EmployeeController::class, 'index'])->name('emp.list');
        Route::get('add', [EmployeeController::class, 'create'])->name('emp.add');
        Route::post('store', [EmployeeController::class, 'store'])->name('emp.store');

    });

    Route::prefix('supplier')->group(function () {
        Route::get('list', [SupplierController::class, 'index'])->name('sup.list');
        Route::get('add', [SupplierController::class, 'create'])->name('sup.add');
        Route::post('store', [SupplierController::class, 'store'])->name('sup.store');
    });

    Route::prefix('product')->group(function () {
        Route::get('list', [ProductController::class,'index'])->name('product.list');
        Route::get('add', [ProductController::class, 'create'])->name('product.add');
        Route::post('store', [ProductController::class,'store'])->name('product.store');
        Route::delete('delete/{product}', [ProductController::class,'destroy'])->name('product.delete');

        Route::get('/stock/add/{product}', [ProductController::class,'stock_add'])->name('stock.add');
        Route::get('/stock/list/{product}', [ProductController::class,'stock_list'])->name('stock.list');
        Route::post('/stock/store', [ProductController::class,'stock_store'])->name('stock.store');
        Route::delete('/stock/delete/{stock}', [ProductController::class,'stock_delete'])->name('stock.delete');
    });
});

require __DIR__.'/auth.php';
