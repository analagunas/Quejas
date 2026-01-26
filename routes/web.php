<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\QuejasDashboardController;
use App\Http\Controllers\PublicQuejaController;

/*
|--------------------------------------------------------------------------
| SSO – LOGIN DESDE AUTH
|--------------------------------------------------------------------------
*/

Route::get('/sso', function (Request $request) {

    if (! $request->email) {
        abort(401, 'Email requerido');
    }

    $user = User::where('email', $request->email)->firstOrFail();

    auth()->login($user);

    return redirect()->route('quejas.dashboard');
})->name('quejas.sso.login');


/*
|--------------------------------------------------------------------------
| RUTA RAÍZ
|--------------------------------------------------------------------------
*/
Route::get('/', function () {

    if (auth()->check()) {
        return redirect()->route('quejas.dashboard');
    }

    return redirect()->route('quejas.create');
});


/*
|--------------------------------------------------------------------------
| FORMULARIO PÚBLICO DE QUEJAS
|--------------------------------------------------------------------------
*/
Route::get('/nueva-queja', [PublicQuejaController::class, 'create'])
    ->name('quejas.create');

Route::post('/nueva-queja', [PublicQuejaController::class, 'store'])
    ->name('quejas.store');

Route::get('/gracias', function () {
    return view('quejas.gracias');
})->name('quejas.gracias');


/*
|--------------------------------------------------------------------------
| DASHBOARD (USUARIOS LOGUEADOS)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [QuejasDashboardController::class, 'index'])
        ->name('quejas.dashboard');

    Route::patch('/{complaint}/status', [QuejasDashboardController::class, 'updateStatus'])
        ->name('quejas.update-status');
});
