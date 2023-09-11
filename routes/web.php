<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\VoteController;

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
    Route::get('/contestants', [ParticipantController::class, 'index'])->name('index')->middleware('fosks');

    Route::get('/contestants/register', [ParticipantController::class, 'create'])->name('create')->middleware('fosks');

    Route::post('/contestants/store',[ParticipantController::class, 'store'])->name('store');

    Route::get('/contestants/{user}/profile',[ParticipantController::class, 'show'])->name('show');

    Route::put('/contestants/{user}/update',[ParticipantController::class, 'update'])->middleware('admin')->name('update');
    // Vote Routes
    Route::post('/contestants/{user}/vote', [VoteController::class, 'store'])->name('vote');

    Route::post('/contestants/vote/pay', [PaymentController::class, 'redirectToGateway'])->name('pay');  // paying for votes

    Route::get('/payment/callback', [PaymentController::class, 'handleCallback'])->name('callback'); // callback from paystack
 
});

Route::prefix('admin')->name('admin.')->middleware(['admin','auth'])->group(function () {
    Route::get('/', [Admin\AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/logout', [Admin\AdminController::class, 'logout'])->name('logout');

    // Participants Routes
    Route::get('/contestants', [Admin\AdminController::class, 'participants'])->name('participants');

    Route::get('/contestants/{user}/edit', [Admin\AdminController::class, 'participant_edit'])->name('participant.edit');

    Route::delete('/contestants/withdrawn', [Admin\AdminController::class, 'participant_withdraw'])->name('participant.withdraw');

    // Revenue Routes
    Route::get('/revenue', [Admin\AdminController::class, 'revenue'])->name('revenue');

    //Settings Routes
    Route::get('/settings', [Admin\SettingsController::class, 'index'])->name('settings.index');

    Route::put('/settings/save', [Admin\SettingsController::class, 'save'])->name('settings.save');

    // Profile Routes
    Route::get('/profile', [Admin\ProfileController::class, 'index'])->name('profile.index');

});

Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('/login', [Admin\AdminController::class, 'login'])->name('login');

    Route::post('/authenticate', [Admin\AdminController::class, 'authenticate'])->name('authenticate');    
});


