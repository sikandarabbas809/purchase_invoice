<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PurchaseInvoiceController;

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

Auth::routes();
Route::middleware('auth')->group(function () {
    Route::get('purchase-invoice', [PurchaseInvoiceController::class, 'index'])->name('purchase-invoice.index');
    Route::get('purchase-invoice/create', [PurchaseInvoiceController::class, 'create'])->name('purchase-invoice.create');
    Route::post('purchase-invoice', [PurchaseInvoiceController::class,'store'])->name('purchase-invoice.store');
    Route::get('purchase-invoice/{purchaseInvoice}', [PurchaseInvoiceController::class,'show'])->name('purchase-invoice.show');
    Route::get('purchase-invoice/{purchaseInvoice}/edit', [PurchaseInvoiceController::class,'edit'])->name('purchase-invoice.edit');
    Route::put('purchase-invoice/{purchaseInvoice}', [PurchaseInvoiceController::class,'update'])->name('purchase-invoice.update');
    Route::delete('purchase-invoice/{purchaseInvoice}', [PurchaseInvoiceController::class,'destroy'])->name('purchase-invoice.destroy');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
