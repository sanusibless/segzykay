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
    Route::put('/models/{user}/update',[ParticipantController::class, 'update'])->middleware('admin')->name('update');

    // Vote Routes
    Route::post('/models/{user}/vote', [VoteController::class, 'store'])->name('vote');
});

Route::prefix('admin')->name('admin.')->middleware(['admin','auth'])->group(function () {

    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/participants', [AdminController::class, 'participants'])->name('participants');
    Route::get('/participants/{user}/edit', [AdminController::class, 'participant_edit'])->name('participant.edit');
    Route::delete('/participants/withdrawn', [AdminController::class, 'participant_withdraw'])->name('participant.withdraw');

    // Revenue Routes
    Route::get('/revenue', [AdminController::class, 'revenue'])->name('revenue');
});

Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('/login', [AdminController::class, 'login'])->name('login');
    Route::post('/authenticate', [AdminController::class, 'authenticate'])->name('authenticate');    
});
