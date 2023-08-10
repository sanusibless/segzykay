<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\AdminController;
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
    return view('index');
})->name('home');

Route::name('participants.')->group(function () {
    Route::get('/models', [ParticipantController::class, 'index'])->name('index');
    Route::get('/models/register', [ParticipantController::class, 'create'])->name('create');
    Route::post('/models/store',[ParticipantController::class, 'store'])->name('store');
    Route::get('/models/{user}/profile',[ParticipantController::class, 'show'])->name('show');

    // Vote Routes
    Route::post('/models/{user}/vote', [VoteController::class, 'store'])->name('vote');
});

Route::prefix('admin')->name('admin.')->middleware(['admin','auth'])->group(function () {
    Route::get('/login', [AdminController::class, 'login'])->withoutMiddleware(['admin','auth'])->name('login');
    Route::post('/authenticate', [AdminController::class, 'authenticate'])->name('authenticate');
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/participants', [AdminController::class, 'participants'])->name('participants');
});
