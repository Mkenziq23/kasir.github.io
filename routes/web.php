<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::resource('/menu', MenuController::class)->missing(fn () => redirect()->back());
    Route::resource('/transaction', TransactionController::class)->missing(fn () => redirect()->back());
    Route::resource('/user', UserController::class)->missing(fn () => redirect()->back());
    
    Route::post('/user/delete', [UserController::class, 'destroy']);
    
    Route::get('/user/edit/{user}', function (User $user) {
        if (Auth::user()->level_id !== $user->level_id) {
            abort(403, 'Unauthorized action.');
        }
        return view('account.edit', [
            'user' => User::with('level')->findOrFail($user->id)
        ]);
    });

    Route::post('/user/edit/{user}', [UserController::class, 'updateProfile']);

    Route::get('/menus/shows', [MenuController::class, 'show']);
    Route::get('/activityLog', [ActivityLogController::class, 'index']);
    Route::get('/report', [ReportController::class, 'index']);
    
    Route::get('/invoice/{transaction}', function (Transaction $transaction) {
        return view('transaction.invoice', [
            'data' => Transaction::with(['transaction_details', 'transaction_details.menu', 'user'])
                        ->findOrFail($transaction->id)
        ]);
    });
});

// Rute login tanpa autentikasi
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
});

// Logout tetap menggunakan autentikasi
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');
