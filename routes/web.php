<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NoteController;
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

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::resource('notes', NoteController::class)->only(['store', 'update', 'destroy']);
    Route::get('/notes/{note}/history', [NoteController::class, 'history'])->name('notes.history');
});
