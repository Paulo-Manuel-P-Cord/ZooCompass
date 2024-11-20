<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


use App\Http\Controllers\AnimalController;
Route::get('/animals', [AnimalController::class, 'index'])->name('animals');
Route::resource('animals', AnimalController::class);



use App\Http\Controllers\PositionController;
Route::get('/positions', [PositionController::class, 'index'])->name('positions.index');
Route::resource('positions', PositionController::class);



use App\Http\Controllers\WorkerController;
Route::resource('workers', WorkerController::class);