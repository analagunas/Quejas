<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicQuejaController;
use App\Http\Controllers\QuejasDashboardController;
use App\Http\Controllers\PublicTrackingController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('quejas.portal');
})->name('portal');


Route::get('/seguimiento', function () {
    return view('quejas.tracking.form');
})->name('quejas.tracking.form');

Route::post('/seguimiento', [PublicTrackingController::class, 'search'])
    ->name('quejas.tracking.search');

Route::post(
    '/tracking/{complaint}/reply',
    [PublicTrackingController::class, 'reply']
)->name('quejas.tracking.reply');




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard-login', function () {
    Auth::logout(); // 🔥 fuerza logout
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('login');
})->name('dashboard.login');

Route::get('/nueva-queja', [PublicQuejaController::class, 'create'])
    ->name('quejas.create');

Route::post('/nueva-queja', [PublicQuejaController::class, 'store'])
    ->name('quejas.store');

Route::get('/gracias', function () {
    return view('quejas.gracias');
})->name('quejas.gracias');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [QuejasDashboardController::class, 'index'])
        ->name('dashboard');

    Route::patch('/{complaint}/status', [QuejasDashboardController::class, 'updateStatus'])
        ->name('quejas.update-status');
    Route::get('/quejas/{complaint}', [PublicQuejaController::class, 'show'])
        ->name('quejas.show');
});


require __DIR__ . '/auth.php';
