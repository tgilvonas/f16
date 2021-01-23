<?php

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

Route::get('/', function () {
    return view('client-frontend.index');
})->name('index');

Route::get('/registracija', function () {
    return view('client-frontend.form-sign-up');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['prefix' => 'savitarna', 'middleware' => ['auth']], function() {
    Route::get('/uzsakymai', [\App\Http\Controllers\OrdersController::class, 'index'])->name('orders.index');
    Route::get('/uzsakymai/{id}', [\App\Http\Controllers\OrdersController::class, 'view'])->name('orders.view');
});

require __DIR__.'/auth.php';
