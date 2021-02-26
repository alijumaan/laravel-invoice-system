<?php

use App\Http\Controllers\GeneralController;
use App\Http\Controllers\InvoiceController;
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

Route::get('/', [InvoiceController::class, 'index'])->name('home');

Route::get('change-language/{locale}',  [GeneralController::class, 'changeLanguage'])->name('change_locale');

Route::get('invoices/print/{id}',       [InvoiceController::class, 'print'])->name('invoices.print');
Route::get('invoices/pdf/{id}',         [InvoiceController::class, 'pdf'])->name('invoices.pdf');
Route::get('invoices/send-email/{id}',  [InvoiceController::class, 'send_to_email'])->name('invoices.send_to_email');

Route::get('invoices/export-all', [InvoiceController::class, 'export_all'])->name('invoices.export');
Route::get('invoices/export-view', [InvoiceController::class, 'export_view'])->name('invoices.export_view');
Route::get('invoices/export-store', [InvoiceController::class, 'export_store'])->name('invoices.export_store');
Route::get('invoices/export-format/{format}', [InvoiceController::class, 'export_format'])->name('invoices.export_format');
Route::get('invoices/export-heading', [InvoiceController::class, 'export_with_heading_row'])->name('invoices.export_with_heading_row');

Route::resource('invoices', InvoiceController::class);
