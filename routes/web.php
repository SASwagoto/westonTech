<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SiteController;
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
    //Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/home', [HomeController::class, 'index'])->name('dashboard');

    Route::get('/language/{lang}', [LangController::class, 'index'])->name('langChange');

    Route::prefix('employee')->group(function () {
        Route::get('list', [EmployeeController::class, 'index'])->name('emp.list');
        Route::get('add', [EmployeeController::class, 'create'])->name('emp.add');
        Route::post('store', [EmployeeController::class, 'store'])->name('emp.store');
        Route::get('show/{employee}', [EmployeeController::class, 'show'])->name('emp.show');
        Route::get('edit/{employee}', [EmployeeController::class, 'edit'])->name('emp.edit');
        Route::patch('update/{employee}', [EmployeeController::class, 'update'])->name('emp.update');
        Route::delete('delete/{employee}', [EmployeeController::class, 'destroy'])->name('emp.delete');
        Route::put('/{id}/restore', [EmployeeController::class, 'restore'])->name('emp.restore');
        Route::delete('/{id}/force-delete', [EmployeeController::class, 'forceDelete'])->name('emp.forceDelete');

    });

    Route::prefix('supplier')->group(function () {
        Route::get('list', [SupplierController::class, 'index'])->name('sup.list');
        Route::get('add', [SupplierController::class, 'create'])->name('sup.add');
        Route::post('store', [SupplierController::class, 'store'])->name('sup.store');
        Route::get('edit/{supplier}', [SupplierController::class, 'edit'])->name('sup.edit');
        Route::put('update/{supplier}', [SupplierController::class, 'update'])->name('sup.update');
        Route::delete('delete', [SupplierController::class, 'destroy'])->name('sup.delete');
    });

    Route::prefix('customer')->group(function (){
        Route::get('/list', [CustomerController::class, 'index'])->name('customer.list');
        Route::get('/add', [CustomerController::class, 'create'])->name('customer.create');
        Route::post('/store', [CustomerController::class, 'store'])->name('customer.store');
        Route::delete('/delete', [CustomerController::class, 'destroy'])->name('customer.delete');
        Route::get('/get-customer', [CustomerController::class, 'getCustomer'])->name('getCustomer');

    });

    Route::prefix('product')->group(function () {
        Route::get('list', [ProductController::class,'index'])->name('product.list');
        Route::get('add', [ProductController::class, 'create'])->name('product.add');
        Route::post('store', [ProductController::class,'store'])->name('product.store');
        Route::get('edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
        Route::put('update/{product}', [ProductController::class, 'update'])->name('product.update');
        Route::delete('delete/{product}', [ProductController::class,'destroy'])->name('product.delete');

        // Route::get('/stock/add/{product}', [ProductController::class,'stock_add'])->name('stock.add');
        // Route::get('/stock/list/{product}', [ProductController::class,'stock_list'])->name('stock.list');
        // Route::post('/stock/store', [ProductController::class,'stock_store'])->name('stock.store');
        // Route::delete('/stock/delete/{stock}', [ProductController::class,'stock_delete'])->name('stock.delete');
    });

    Route::prefix('order')->group(function () {
        Route::get('/list', [SaleController::class,'index'])->name('order.list');
        Route::get('/add', [OrderController::class,'create'])->name('order.add');
        Route::post('/store', [OrderController::class,'store'])->name('order.store');
        Route::get('/checkout/{sale}', [SaleController::class, 'show'])->name('order.checkout');
        Route::post('/sale', [SaleController::class, 'update'])->name('order.sold');
        Route::post('/duepay', [SaleController::class, 'duePay'])->name('order.duepay');
        Route::get('/invoice/{sale}', [InvoiceController::class, 'show'])->name('sale.invoice');
    });

    Route::prefix('cart')->group(function () {
        Route::get('/add-to-cart', [CartController::class, 'addCart'])->name('cart.add');
        Route::post('/priceUpdate', [CartController::class,'updatePrice'])->name('cart.updatePrice');
        Route::get('/remove/{id}', [CartController::class,'removeCart'])->name('cart.remove');
        Route::get('/remove-all', [CartController::class,'removeCartAll'])->name('cart.removeAll');
    });

    Route::prefix('accounts')->group(function () {
        Route::get('/', [AccountController::class, 'index'])->name('acc.index');
        Route::get('/create', [AccountController::class, 'create'])->name('acc.create');
        Route::post('/store', [AccountController::class, 'store'])->name('acc.store');
        Route::delete('/delete', [AccountController::class, 'destroy'])->name('acc.delete');
        Route::get('/statements/{id}', [AccountController::class,'statments'])->name('acc.stats');

        Route::get('/incomes', [AccountController::class,'incomes'])->name('acc.incomes');
        Route::post('/income/create', [AccountController::class,'addIncome'])->name('acc.addIncome');
        Route::put('/income/edit', [AccountController::class,'editIncome'])->name('acc.editIncome');
        Route::delete('/income/delete', [AccountController::class,'deleteIncome'])->name('acc.incomeDelete');

        Route::get('/expenses', [AccountController::class,'expenses'])->name('acc.expenses');
        Route::post('/expense/create', [AccountController::class,'addExpense'])->name('acc.addExpense');
        Route::put('/expense/edit', [AccountController::class,'editExpense'])->name('acc.editExpense');
        Route::delete('/expense/delete', [AccountController::class,'deleteExpense'])->name('acc.ExpenseDelete');
    });

    Route::prefix('report')->group(function(){
        Route::get('/sales-report',[ReportController::class, 'saleReport'])->name('report.sale');
        Route::get('/sales-report-by-date',[ReportController::class, 'saleReportByDate'])->name('saleReportByDate');
    });

    Route::prefix('settings')->group(function (){
        Route::get('/site', [SiteController::class,'index'])->name('settings.index');
        Route::post('/site/{site}', [SiteController::class,'update'])->name('settings.update');
        route::get('/trash', [ReportController::class, 'trashbox'])->name('settings.trash');
    });

});

require __DIR__.'/auth.php';
