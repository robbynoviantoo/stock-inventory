<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemHistoryController;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('items.index');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Inventory - dilindungi auth
Route::middleware('auth')->group(function () {
    Route::resource('items', ItemController::class);
    Route::get('items-data', [ItemController::class, 'data'])->name('items.data');

    Route::get('items/{item}/history', function (Item $item) {
        return view('items.history', compact('item'));
    })->name('items.history');

    Route::post('histories', [ItemHistoryController::class, 'store'])->name('item_histories.store');

    Route::get('/histories', [ItemHistoryController::class, 'index'])->name('item_histories.index');

    Route::get('/items/export/{format}', [ItemController::class, 'export'])->name('items.export');

    Route::get('/items/data/import', [ItemController::class, 'importPage'])->name('items.import.page');
    Route::post('/items/data/import', [ItemController::class, 'import'])->name('items.import');
});
