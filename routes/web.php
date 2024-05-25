<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CustomerController;

Route::get('customers', [CustomerController::class, 'index'])->name('customers.index');
Route::post('customers/import', [CustomerController::class, 'import'])->name('customers.import');
Route::post('customers', [CustomerController::class, 'store'])->name('customers.store');
Route::get('customers/export', [CustomerController::class, 'export'])->name('customers.export');
