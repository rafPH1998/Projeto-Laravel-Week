<?php

use App\Http\Controllers\BeerController;
use App\Http\Controllers\ExportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/beers', BeerController::class)
    ->middleware(['auth'])
    ->group(function() {
        Route::get('/', [BeerController::class, 'index']);
        Route::get('/export', [BeerController::class, 'export']);

        Route::resource('reports', ExportControllerroller::class)
            ->only(['index', 'show', 'destroy']);
    });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
require __DIR__.'/auth.php';
