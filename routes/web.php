<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::resource('products', ProductController::class);
Route::get('/', [DashboardController::class, 'index']);

Route::get('/dashboard', [DashboardController::class, 'index']);


Route::get('/products', [ProductController::class, 'index'])->name('products.index');


Route::get('/dashboard', [DashboardController::class, 'index']);

Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');

Route::get('/products/create', [ProductController::class, 'create'])
    ->name('products.create');

Route::post('/products/store', [ProductController::class, 'store'])
    ->name('products.store');

Route::get('products/trash', [ProductController::class, 'trash'])
    ->name('products.trash');

Route::get('products/restore/{id}', [ProductController::class, 'restore'])
    ->name('products.restore');

Route::get('products/force-delete/{id}', [ProductController::class, 'forceDelete'])
    ->name('products.forceDelete');

Route::delete('/products/bulk-delete',[ProductController::class, 'bulkDelete'])->name('products.bulkDelete');

Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

Route::post('/products/import', [ProductController::class, 'import'])->name('products.import');

Route::post('/products/trash/bulk-action',
    [ProductController::class, 'trashBulkAction']
)->name('products.trash.bulkAction');

Route::get('/bulk-products', function(){
    return view('products.bulk_product');
})->name('bulk-products');



// Route::get('products/trash', [ProductController::class, 'trash'])->name('products.trash');
// Route::get('products/restore/{id}', [ProductController::class, 'restore'])->name('products.restore');
// Route::get('products/force-delete/{id}', [ProductController::class, 'forceDelete'])->name('products.forceDelete');
